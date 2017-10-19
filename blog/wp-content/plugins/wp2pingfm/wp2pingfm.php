<?php
/*
Plugin Name: WordPress 2 Ping.fm
Plugin URI: http://jacobanderic.com
Description: Links and integrate your WordPress account to Ping.fm. Once linked, the plugin will update all your social networks every time you publish a post. You can customize the look of your pings, send custom pings, and set rules for which categories you want to notify your social networks about. This is la creme de la creme of social network plugins, created by people who just happen to specialize in communication and social networks. You will need a Ping.fm account and an application key to use this plugin, which you can get for free at http://ping.fm/
Version: 1.5
Author: Jacob Guite-St-Pierre & Sylvain Mallet
Author URI:  http://jacobanderic.com
*/

//define('API_KEY', '41121eb3a56f921bc2957b2458d65bad'); // old key
define('API_KEY', 'c4c6362a0276386d291e04f15b44b116'); // developer key

add_action('publish_post', 'wp2pingfm_submit_to_ping_fm');
add_action('admin_menu', 'wp2pingfm_submit_config_admin');

function wp2pingfm_submit_to_ping_fm($postId)
{
    $continue = false;
    $categories = array();
    if(!wp_is_post_revision($postId))
    {
        $this_post_submitted = get_option('wp2pingfm_submit_post_submitted_'.$postId, false);
        if(!$this_post_submitted)
        {
            $continue = true;
        }

        if($continue)
        {
            $theCats = get_the_category($postId);
            foreach($theCats as $cats)
            {
                $categories[] = $cats->cat_ID;
                $categories[] = $cats->category_nicename;
            }
            $continue = isCategoriesAllowedToPing($postId, $categories);
        }
        if($continue)
        {
            update_option('wp2pingfm_submit_post_submitted_'.$postId, true);
            submitPingFM($postId);
        }
    }
}


function wp2pingfm_submit_config_admin()
{
    add_submenu_page('options-general.php', 'Ping.fm', 'Ping.fm', 'level_10', 'wp2pingfm', 'wp2pingfm_submit_status_update');
}

function wp2pingfm_submit_status_update() {
	if(!empty($_POST["je_status_message"])){
		statusUpdate($_POST["je_status_message"]);
		echo '<div class="updated"><p><strong>Ping Sent!</strong></p></div>';
	}
?>
<div class="wrap">

<h2>Ping Update</h2>

<script language="javascript">
	function je_counter(){
		var span;
		var counter = document.getElementById('je_status_message').value.length;
		if (counter<=140)
			color = '#3c8036';
		else
			color = '#ff0000';
		span = '<span style="color: '+color+'; font-family: Georgia; font-size: 200%;">'+counter+'</span> Characters';	
		document.getElementById('ctrchar').innerHTML = span;
	}
</script>

<form method="post" action="options-general.php?page=wp2pingfm">

<textarea rows="3" cols="60" name="je_status_message" id="je_status_message" onkeydown="je_counter();" onkeyup="je_counter();"></textarea>
<div id="ctrchar" style="padding:4px 0 2px 0;"></div>
<div style="font-size: 90%;"><em>
SMS and Twitter's limit is 140 characters<br />
Ping.fm will automatically shorten your links to about 20 characters
</em></div>


<div class="submit">
<input type="submit" class="button-primary" value="Send Ping" />
</div>


</form>
</div>

<br /><br />
<?php
wp2pingfm_submit_config_form();
}

function wp2pingfm_submit_config_form() {
?>
<div class="wrap">
<h2>WordPress 2 Ping.fm Options</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table class="form-table">

<tr valign="top">
<th scope="row"><label for="option_key">Application Key:</label></th>
<td><input type="text" size="45" id="option_key" name="je_post_pingfm_api_key" value="<?php echo get_option('je_post_pingfm_api_key'); ?>" /><br />
<label for="option_key"><em>Get your key at <a href="http://ping.fm/key/" target="_blank">http://ping.fm/key/</a></em></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="option_template">Template:</label></th>
<td>
<input type="text" size="45" id="option_template" name="je_post_pingfm_message_template" value="<?php echo get_option('je_post_pingfm_message_template', '{title}: {url}'); ?>" /><br />
<label for="option_template"><strong>{title}</strong> = <em>Post Title</em> <br /> <strong>{url}</strong> = <em>Permalink</em> </label>
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="option_all">Options:<br /></label></th>
<td>
    <input type="radio" id="option_all" name="je_post_pingfm_ping_mode" value="all" <?php if(get_option('je_post_pingfm_ping_mode') == "all") { echo 'checked="checked"'; }?> /> <label for="option_all"><strong>All</strong> categories</label><br />
    <input type="radio" id="option_allow" name="je_post_pingfm_ping_mode" value="allow" <?php if(get_option('je_post_pingfm_ping_mode') == "allow") { echo 'checked="checked"'; }?> /> <label for="option_allow"><strong>Include</strong> following categorie(s) only</label><br />
    <input type="radio" id="option_deny" name="je_post_pingfm_ping_mode" value="deny" <?php if(get_option('je_post_pingfm_ping_mode') == "deny") { echo 'checked="checked"'; }?> /> <label for="option_deny"><strong>Exclude</strong> following categorie(s) only</label><br />
    <input type="radio" id="option_none" name="je_post_pingfm_ping_mode" value="none" <?php if(get_option('je_post_pingfm_ping_mode') == "none") { echo 'checked="checked"'; }?> /> <label for="option_none"><strong>None</strong> (essentially disables the plugin)</label>
</td>

<tr valign="top">
<th scope="row"><label for="option_cats">Categorie(s):</label></th>
<td>
<input type="text" size="45" id="option_cats" name="je_post_pingfm_ping_mode_category" value="<?php echo get_option('je_post_pingfm_ping_mode_category'); ?>" /><br /><label for="option_cats"><em>IDs or slugs separated by commas</em></label>
</td>
</tr>

</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="je_post_pingfm_message_template,je_post_pingfm_api_key,je_post_pingfm_ping_mode_category,je_post_pingfm_ping_mode" />

<p class="submit">
<input type="submit" value="Update Options" />
</p>

</form>
</div>
<?php
}

function statusUpdate($status) {
	if(empty($link))$link=get_bloginfo('url');
	if (!empty($status)) {
		global $debug;
		include_once('pingfm.php');
		$user_API_key = get_option('je_post_pingfm_api_key');
		$ping_template = get_option('je_post_pingfm_message_template');
		$pingfm = new pingfm(API_KEY, $user_API_key);
		$ping_template = $status;
    	$result = $pingfm->post("status", $ping_template);
		//echo $result; used to debut
	}
}

function submitPingFM($postId)
{
    $post = get_post($postId);
    include_once('pingfm.php');
    $user_API_key = get_option('je_post_pingfm_api_key');
    $ping_template = get_option('je_post_pingfm_message_template');
    $pingfm = new pingfm(API_KEY, $user_API_key, false);
    $arrTemplate = array(
        '{title}' => $post->post_title,
        '{url}' => get_permalink($postId),
    );

    foreach($arrTemplate as $template => $template_data) {
        $ping_template = str_replace($template, $template_data, $ping_template);
    }
    $result = $pingfm->post("status", $ping_template);
}

function isCategoriesAllowedToPing($postId, $categories)
{
    $pingMode = get_option('je_post_pingfm_ping_mode');
    $pingCats = get_option('je_post_pingfm_ping_mode_category');
    $pingCats = array_map("trim", explode(",", $pingCats));
    if(!is_array($pingCats)) $pingCats = array();

    if ("all" == $pingMode) return true;
    
    if ("none" == $pingMode) return false;
    
    if ("allow" == $pingMode)
    {
        foreach($categories as $cats)
        {
            if(in_array($cats, $pingCats))
            {
                return true;
            }
        }
    }
    
    else if("deny" == $pingMode)
    {
        foreach($categories as $cats)
        {
            if(in_array($cats, $pingCats))
            {
                return false;
            }
        }
        return true;
    }
}
