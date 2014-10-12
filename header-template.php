<?php
/**
 * The header for home page.
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title('|', true, 'right'); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="template-site">
	<header class="template-header">
		<div class="home-logo onetone-logo ">
        	<a href="<?php echo esc_url(home_url('/')); ?>">
        <?php if ( onetone_options_array('logo')!="") { ?>
        <img src="<?php echo onetone_options_array('logo'); ?>" alt="<?php bloginfo('name'); ?>" />
        <?php }else{ ?>
        <span class="site-name">
        <?php bloginfo('name'); ?>
        </span>
        <?php }?>
        </a>
        <?php if ( 'blank' != get_header_textcolor() && '' != get_header_textcolor() ){?>
        <div class="site-description "><?php bloginfo('description'); ?></div>
        <?php }?>
        </div>
        
        <a class="home-navbar navbar" href="javascript:;"></a>
        <nav class="home-navigation top-nav">
        
<?php wp_nav_menu( array('theme_location'=>'primary', 'depth'=>0, 'fallback_cb' =>false, 'container'=>'', 'container_class'=>'main-menu','menu_id'=>'menu-main', 'menu_class'=>'main-nav', 'link_before' => '<span>', 'link_after' => '</span>') );
?>
        </nav>
		<div class="clear"></div>
	</header>    
	<!--header-->