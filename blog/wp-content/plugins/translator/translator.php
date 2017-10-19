<?php
/*
Plugin Name: Translator
Plugin URI: http://www.yellingnews.com/wordpress-plugins
Description: Translates your blog to 35 languages with just one click via the great google translation service. Check out more <a href="http://www.yellingnews.com/wordpress-plugins">Wordpress Plugins</a> brought to you by Yellingnews <a href="http://www.yellingnews.com">Gadgets</a>.
Version: 0.2
Author: yellingnews
Author URI: http://www.yellingnews.com
*/
 
/**
 * v0.2 26.06.2009 small codefix in admin panel
 * v0.1 18.06.2009 initial release
 */

class Translator {
  var $id;
  var $title;
  var $plugin_url;
  var $version;
  var $name;
  var $url;
  var $options;
  var $locale;

  function Translator() {
    $this->id         = 'translator';
    $this->title      = 'Translator';
    $this->version    = '0.2';
    $this->plugin_url = 'http://www.yellingnews.com/wordpress-plugins';
    $this->name       = 'Translator v'. $this->version;
    $this->url        = get_bloginfo('wpurl'). '/wp-content/plugins/' . $this->id;
    $this->languages  = array(
      'ar' => __('Arabic', $this->id),
      'bg' => __('Bulgarian', $this->id),
      'ca' => __('Catalan', $this->id),
      'cs' => __('Czech', $this->id),
      'da' => __('Danish', $this->id),
      'de' => __('German', $this->id),
      'el' => __('Greek', $this->id),
      'en' => __('English', $this->id),
      'es' => __('Spanish', $this->id),
      'fi' => __('Finnish', $this->id),
      'fr' => __('French', $this->id),
      'hi' => __('Hindi', $this->id),
      'hr' => __('Croatian', $this->id),
      'id' => __('Indonesian', $this->id),
      'it' => __('Italian', $this->id),
      'iw' => __('Hebrew', $this->id),
      'ja' => __('Japanese', $this->id),
      'ko' => __('Korean', $this->id),
      'lt' => __('Lithuanian', $this->id),
      'lv' => __('Latvian', $this->id),
      'nl' => __('Dutch', $this->id),
      'no' => __('Norwegian', $this->id),
      'pl' => __('Polish', $this->id),
      'pt' => __('Portuguese', $this->id),
      'ro' => __('Romanian', $this->id),
      'ru' => __('Russian', $this->id),
      'sk' => __('Slovak', $this->id),
      'sl' => __('Slovenian', $this->id),
      'sr' => __('Serbian', $this->id),
      'sv' => __('Swedish', $this->id),
      'tl' => __('Filipino', $this->id),
      'uk' => __('Ukrainian', $this->id),
      'vi' => __('Vietnamese', $this->id),
      'zh-CN' => __('Chinese/simp.', $this->id),
      'zh-TW' => __('Chinese/trad.', $this->id)
    );

	  $this->locale     = get_locale();
    $this->path       = dirname(__FILE__);

	  if(empty($this->locale)) {
		  $this->locale = 'en_US';
    }

    load_textdomain($this->id, sprintf('%s/%s.mo', $this->path, $this->locale));

    $this->loadOptions();

    if(!is_admin()) {
      add_filter('wp_head', array(&$this, 'blogHeader'));
    }
    else {
      add_action('admin_menu', array( &$this, 'optionMenu')); 
    }

    add_action('widgets_init', array( &$this, 'initWidget')); 
  }

  function optionMenu() {
    add_options_page($this->title, $this->title, 8, __FILE__, array(&$this, 'optionMenuPage'));
  }

  function optionMenuPage() {
?>
<div class="wrap">
<h2><?=$this->title?></h2>
<div align="center"><p><?=$this->name?> <a href="<?php print( $this->plugin_url ); ?>" target="_blank">Plugin Homepage</a></p></div> 
<?php
  if(isset($_POST[ $this->id ])) {

    $this->updateOptions( $_POST[ $this->id ] );

    echo '<div id="message" class="updated fade"><p><strong>' . __( 'Settings saved!', $this->id) . '</strong></p></div>'; 
  }
?>
<form method="post" action="options-general.php?page=<?=$this->id?>/<?=$this->id?>.php">

<table class="form-table">

<tr valign="top">
  <th scope="row"><?php _e('Title', $this->id); ?></th>
  <td colspan="3"><input name="translator[title]" type="text" id="" class="code" value="<?=$this->options['title']?>" /><br /><?php _e('Title is shown above the Widget. If left empty can break your layout in widget mode!', $this->id); ?></td>
</tr>

</table>

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('save', $this->id); ?>" class="button" />
</p>
</form>

</div>
<?php
  }

  function updateOptions($options) {

    foreach($this->options as $k => $v) {
      if(array_key_exists( $k, $options)) {
        $this->options[ $k ] = trim($options[ $k ]);
      }
    }
        
		update_option($this->id, $this->options);
	}
  
  function loadOptions() {
    $this->options = get_option( $this->id );

    if( !$this->options ) {
      $this->options = array(
        'installed' => time(),
        'title' => 'Translator'
			);

      add_option($this->id, $this->options, $this->name, 'yes');
      
      if(is_admin()) {
        add_filter('admin_footer', array(&$this, 'addAdminFooter'));
      }
    }

  }

  function initWidget() {
    if(function_exists('register_sidebar_widget')) {
      register_sidebar_widget($this->title . ' Widget', array($this, 'showWidget'), null, 'widget_translator');
    }
  }

  function showWidget( $args ) {
    extract($args);
    printf( '%s%s%s%s%s%s', $before_widget, $before_title, $this->options['title'], $after_title, $this->getCode(), $after_widget );
  }

  function blogHeader() {
    printf('<meta name="%s" content="%s/%s" />' . "\n", $this->id, $this->id, $this->version);
    printf('<link rel="stylesheet" href="%s/styles/%s.css" type="text/css" media="screen" />'. "\n", $this->url, $this->id);
  }

  function getCode() {
    $data = '';
    
    foreach($this->languages as $k => $v ) {
      $data .= sprintf('<option value="%s">%s</option>', $k, $v);
    }
    return sprintf('<div id="%s"><form action="http://translate.google.com/translate" target="_blank"><input type="hidden" name="u" value="%s" /><select name="tl" onchange="this.form.submit();"><option value="-1">%s</option>%s</select></form><small><a href="http://www.yellingnews.com/wordpress-plugins" target="_blank">%s</a> by <a href="http://www.yellingnews.com" target="_blank">Yellingnews</a></small></div>', $this->id, get_bloginfo('wpurl'), __('Translate to', $this->id), $data, $this->title);
  }
}

function translator_display() {

  global $Translator;

  if($Translator) {
    echo $Translator->getcode();
  }
}

add_action( 'plugins_loaded', create_function( '$Translator_5alpl', 'global $Translator; $Translator = new Translator();' ) );

?>