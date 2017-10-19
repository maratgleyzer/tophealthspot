
	<div class="span-5 last">
		<div class="sidebar sidebar-right">
			<ul><li><h2>Go to our website</h2></li>
			<ul id="ths_pageLink"><li><a href="http://www.tophealthspot.com" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/top-health-blog-btn.png" alt="Top Health Spot Website Link"/></a></li></ul>
            </ul>
            <div class="sidebaradbox">
    			<?php sidebar_ads_125(); ?>
    		</div>
                
             <?php
        		if(get_theme_option('rssbox') == 'true') {
        			?>
        			<div class="rssbox">
        				<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/rss.png"  alt="RSS Feed" title="RSS Feed" style="vertical-align:middle; margin-right: 5px;"  /></a><a href="<?php bloginfo('rss2_url'); ?>"><?php echo get_theme_option('rssboxtext'); ?></a>
        			</div>
        			<?php
        		}
        	?>
        	
        	<?php
        		if(get_theme_option('twitter') != '') {
        			?>
        			<div class="twitterbox">
        				<a href="<?php echo get_theme_option('twitter'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/twitter.png"  alt="<?php echo get_theme_option('twittertext'); ?>" title="<?php echo get_theme_option('twittertext'); ?>" style="vertical-align:middle; margin-right: 5px;"  /></a><a href="<?php echo get_theme_option('twitter'); ?>"><?php echo get_theme_option('twittertext'); ?></a>
        			</div>
        			<?php
        		}
        	?>
			<ul>
				<?php 
						if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : ?>
					
					<li id="tag_cloud"><h2>Tags</h2>
						<?php wp_tag_cloud('largest=16&format=flat&number=20'); ?>
					</li>
					
					<li><h2>Archives</h2>
						<ul>
						<?php wp_get_archives('type=monthly'); ?>
						</ul>
					</li>
					
					<li> 
						<h2>Calendar</h2>
						<?php get_calendar(); ?> 
					</li>
					<?php wp_list_bookmarks(); ?>
						
				<li><h2>Meta</h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
						<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
						<?php wp_meta(); ?>
					</ul>
					</li>
	
				<?php endif; ?>
			</ul>
		<?php if(get_theme_option('ad_sidebar2_bottom') != '') {
		?>
		<div class="sidebaradbox">
			<?php echo get_theme_option('ad_sidebar2_bottom'); ?>
		</div>
		<?php
		}
		?>
		</div>
		
	</div>
