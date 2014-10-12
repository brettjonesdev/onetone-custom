<?php
// global $wp_registered_sidebars;
#########################################
function onetone_widgets_init() {
		register_sidebar(array(
			'name' => 'Displayed Everywhere',
			'before_widget' => '<div id="%1$s" class="widget %2$s">', 
			'after_widget' => '<span class="seperator extralight-border"></span></div>', 
			'before_title' => '<h3 class="widgettitle">', 
			'after_title' => '</h3>', 
			));
			
}
add_action( 'widgets_init', 'onetone_widgets_init' );