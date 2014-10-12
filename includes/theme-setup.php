<?php


function onetone_setup(){
	global $content_width;
	$lang = get_template_directory(). '/languages';
	load_theme_textdomain('onetone', $lang);
	add_theme_support( 'post-thumbnails' ); 
	$args = array();
	$header_args = array( 
	    'default-image'          => '',
		 'default-repeat' => 'repeat',
        'default-text-color'     => 'CC9966',
        'width'                  => 1120,
        'height'                 => 80,
        'flex-height'            => true
     );
	add_theme_support( 'custom-background', $args );
	add_theme_support( 'custom-header', $header_args );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('nav_menus');
	register_nav_menus( array('primary' => __( 'Primary Menu', 'onetone' )));
	register_nav_menus( array('home_menu' => __( 'Home Page Header Menu', 'onetone' )));
	add_editor_style("editor-style.css");
	if ( ! isset( $content_width ) ) $content_width = 1120;
	
}

add_action( 'after_setup_theme', 'onetone_setup' );


 function onetone_custom_scripts(){
    wp_enqueue_style('onetone-font-awesome',  get_template_directory_uri() .'/css/font-awesome.min.css', false, '4.0.3', false);
	wp_enqueue_style( 'onetone-main', get_stylesheet_uri(), array(), '1.2.8' );
	wp_enqueue_style('Yanone-Kaffeesatz', esc_url('//fonts.googleapis.com/css?family=Yanone+Kaffeesatz|Lustria|Raleway|Open+Sans:400,300'), false, '', false );
	
	
		
   $background_array  = onetone_options_array("page_background");
   $background        = onetone_get_background($background_array);
   $header_image      = get_header_image();
   $onetone_custom_css = "";
	if (isset($header_image) && ! empty( $header_image )) {
	$onetone_custom_css .= ".home-header{background:url(".$header_image. ") repeat;}\n";
	}
    if ( 'blank' != get_header_textcolor() && '' != get_header_textcolor() ){
     $header_color        =  ' color:#' . get_header_textcolor() . ';';
	 $onetone_custom_css .=  '.home-header,.site-name,.site-description{'.$header_color.'}';
		}
	$custom_css           =  onetone_options_array("custom_css");
	$onetone_custom_css  .=  '.site{'.$background.'}';
	
	
	$top_menu_font_color = onetone_options_array( 'font_color');
	if($top_menu_font_color !="" && $top_menu_font_color!=null){
		$onetone_custom_css  .=  'header #menu-main > li > a span,header .top-nav > ul > li > a span{color:'.$top_menu_font_color.'}';
		}
	
	$onetone_custom_css  .=  $custom_css;
	
	wp_add_inline_style( 'onetone-main', $onetone_custom_css );
	if(is_home()){
	wp_enqueue_script( 'onetone-bigvideo', get_template_directory_uri().'/js/jquery.tubular.1.0.js', array( 'jquery' ), '1.0', true );
	}
	wp_enqueue_script( 'onetone-modernizr', get_template_directory_uri().'/js/modernizr.custom.js', array( 'jquery' ), '2.8.2 ', false );
	wp_enqueue_script( 'onetone-unslider', get_template_directory_uri().'/js/unslider.js', array( 'jquery' ), '1.0.0 ', true );
	wp_enqueue_script( 'onetone-default', get_template_directory_uri().'/js/onetone.js', array( 'jquery' ), '1.2.8', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){wp_enqueue_script( 'comment-reply' );}
	wp_localize_script( 'onetone-default', 'onetone_params', array(
			'ajaxurl'        => admin_url('admin-ajax.php'),
			'themeurl' => get_template_directory_uri(),
		)  );
	
	}
	
   if (!is_admin()) {
  add_action( 'wp_enqueue_scripts', 'onetone_custom_scripts' );
  }

if ( !function_exists( 'onetone_of_get_option' ) ) {
function onetone_of_get_option($name, $default = false) {
	
	$optionsframework_settings = get_option(ONETONE_OPTIONS_PREFIXED.'optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
		
	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}


function onetone_of_get_options($default = false) {
	
	$optionsframework_settings = get_option(ONETONE_OPTIONS_PREFIXED.'optionsframework');
	
	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];
	
	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}
		
	if ( isset($options) ) {
		return $options;
	} else {
		return $default;
	}
}


global $onetone_options;
$onetone_options = onetone_of_get_options();

function onetone_options_array($name){
	global $onetone_options;
	if(isset($onetone_options[$name]))
	return $onetone_options[$name];
	else
	return "";
}
// set default options
function onetone_on_switch_theme(){
global $onetone_options;
 $optionsframework_settings = get_option( ONETONE_OPTIONS_PREFIXED.'optionsframework' );
 if(!get_option($optionsframework_settings['id'])){
 $config = array();
 $output = array();
 $location = apply_filters( 'options_framework_location', array('admin-options.php') );

	        if ( $optionsfile = locate_template( $location ) ) {
	            $maybe_options = require_once $optionsfile;
	            if ( is_array( $maybe_options ) ) {
					$options = $maybe_options;
	            } else if ( function_exists( 'optionsframework_options' ) ) {
					$options = optionsframework_options();
				}
	        }
		if(isset($options)){
	    $options = apply_filters( 'of_options', $options );
		$config  =  $options;
		foreach ( (array) $config as $option ) {
			if ( ! isset( $option['id'] ) ) {
				continue;
			}
			if ( ! isset( $option['std'] ) ) {
				continue;
			}
			if ( ! isset( $option['type'] ) ) {
				continue;
			}
				$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
		}
		}
		add_option($optionsframework_settings['id'],$output);

		
}
$onetone_options = onetone_of_get_options();
}
add_action( 'after_setup_theme', 'onetone_on_switch_theme' );
add_action('after_switch_theme', 'onetone_on_switch_theme');

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'onetone_optionsframework_custom_scripts');

function onetone_optionsframework_custom_scripts() { 

}

add_filter('options_framework_location','onetone_options_framework_location_override');

function onetone_options_framework_location_override() {
	return array('includes/admin-options.php');
}

function onetone_optionscheck_options_menu_params( $menu ) {
	
	$menu['page_title'] = __( 'Onetone Options', 'onetone');
	$menu['menu_title'] = __( 'Onetone Options', 'onetone');
	$menu['menu_slug'] = 'onetone-options';
	return $menu;
}

add_filter( 'optionsframework_menu', 'onetone_optionscheck_options_menu_params' );

function onetone_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( ' Page %s ', 'onetone' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'onetone_wp_title', 10, 2 );


function onetone_title( $title ) {
if ( $title == '' ) {
  return 'Untitled';
  } else {
  return $title;
  }
}
add_filter( 'the_title', 'onetone_title' );