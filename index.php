<?php
/**
* The main template file.
*
*/
 ?>
<?php
if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && $wp_query->get_queried_object_id() == get_option( 'page_for_posts' ) ) {
get_header("site");
?>
<div class="site-main">
		<div class="main-content">
			<div class="content-area">
				<div class="site-content" role="main">
					<header class="archive-header">
						<h1 class="archive-title"><?php onetone_get_breadcrumb();?></h1>
					</header>
					<?php if (have_posts()) :?>
                    <?php while ( have_posts() ) : the_post(); 
					
					    get_template_part("content","article");
					?>
                   <?php endwhile;?>
                   <?php endif;?>
					
					<nav class="paging-navigation">
						<div class="loop-pagination">
							<?php if(function_exists("onetone_native_pagenavi")){onetone_native_pagenavi("echo",$wp_query);}?>
						</div>
					</nav>
				</div>
			</div>
		</div>
		<!--main--> 

		<div class="sidebar">
			<div class="widget-area">
		<?php dynamic_sidebar("default_sidebar") ;?>
			</div>
		</div>
		<!--sidebar--> 
	</div>
<?php
get_footer("site");
}else{
?>

<?php 
get_header();
?>
<div class="home-wrapper">
<?php
 global $onetone_options;
 
 $video_array               = array();
 $section_num               = onetone_options_array( 'section_num' ); 
 $section_background_video  = onetone_options_array( 'section_background_video_0' );
 $video_background_section  = onetone_options_array( 'video_background_section' );
 $video_background_section  = $video_background_section == ""?1:$video_background_section;
 $video_controls            = onetone_options_array( 'video_controls' );
 $video_controls            = $video_controls == ""?1:$video_controls;
 $section_1_content         = onetone_options_array( 'section_1_content' );
 $video_background_type     = onetone_options_array( 'video_background_type' );
 $video_background_type     = $video_background_type == ""?"youtube":$video_background_type;
 

 if(isset($section_num) && is_numeric($section_num ) && $section_num >0):
 for( $i = 0; $i < $section_num ;$i++){
	 
	 if( $section_1_content == 'slider' && $i == 0 ){
		 
		echo onetone_get_default_slider(); 
		 
		 }else{
 
 $section_title       = onetone_options_array( 'section_title_'.$i );
 $section_title_color = onetone_options_array( 'section_title_color_'.$i);
 $section_menu        = onetone_options_array( 'menu_title_'.$i );
 $section_background  = onetone_options_array( 'section_background_'.$i );
 $parallax_scrolling  = onetone_options_array( 'parallax_scrolling_'.$i );
 $section_css_class   = onetone_options_array( 'section_css_class_'.$i );
 $section_content     = onetone_options_array( 'section_content_'.$i );
 $background_size     = onetone_options_array( 'background_size_'.$i );
 $full_width          = onetone_options_array( 'full_width_'.$i );
 
 $mp4_video_url       = onetone_options_array( 'mp4_video_url' );
 $ogv_video_url       = onetone_options_array( 'ogv_video_url' );
 $webm_video_url      = onetone_options_array( 'webm_video_url' );
 $poster_url          = onetone_options_array( 'poster_url' );
 $video_loop          = onetone_options_array( 'video_loop' );
 $video_volume        = onetone_options_array( 'video_volume' );
 $video_volume        = $video_volume == "" ? 0.8 : $video_volume ;
 
  if(!isset($section_content) || $section_content=="") $section_content     = onetone_options_array( 'sction_content_'.$i );
 $section_slug        = onetone_options_array( 'menu_slug_'.$i );

 $background = onetone_get_background($section_background);
 $sanitize_title = "";
 if($section_menu  && $section_menu  != ""){
 $sanitize_title = sanitize_title($section_menu );
 if(trim($section_slug) !=""){
	 $sanitize_title = $section_slug; 
	 }
 }
 $css_class = isset($section_css_class)?$section_css_class:"";
 
  $background_video = '';
  $video_wrap = '';
  $video_enable = 0;
  $detect = new Mobile_Detect;
  if(  $video_background_section == ($i+1) && !$detect->isMobile() && !$detect->isTablet() ){
	$video_enable = 1;  
	$video_wrap   = "video-section";
	$background = "";
  }
  
 if( $video_enable == 1 && $video_background_type == "youtube"){

    $background_video  = array("videoId"=>$section_background_video, "start"=>3 ,"container" =>"section.onetone-".$sanitize_title,"playerid"=>$sanitize_title);
    $video_section_item = "section.onetone-".$sanitize_title;
    $video_array[]  =  array("options"=>$background_video,  "video_section_item"=>$video_section_item );
	
	}
	
 

 if( $parallax_scrolling == "yes" ){
	 $css_class  .= ' onetone-parallax';
	 $background .= 'background-attachment:fixed;background-position:50% 0;background-repeat:no-repeat;';
	 }
	 
  if( $background_size == "yes" ){
	  $background .= '-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;';
  }
  
  $title_style = "";
  if( $section_title_color != "" && $section_title_color != null )
  {
	  $title_style = 'color:'.$section_title_color;
	  }
  $container_class = "container";
  $container_style = "";
  if( $full_width == "yes" ){
  $container_class = "";
  $container_style = "padding: 0;";
  }

 ?>
 <section id="<?php echo $sanitize_title;?>" class="section <?php echo $css_class;?> onetone-<?php echo $sanitize_title;?> <?php echo $video_wrap;?>"  style=" <?php echo $background; ?>">
    	<div class="home-container <?php echo $container_class; ?> page_container"  style=" <?php echo $container_style;?>">
		<?php if($section_title){?>
        	<h1 class="section-title" style=" <?php echo $title_style;?>"><?php echo $section_title;?></h1>
            <?php } ?>
            <?php echo do_shortcode($section_content);?>
            
        </div>
		<div class="clear"></div>
     <?php 
	  if( $video_enable == 1 && $video_controls == 1 && $video_background_type == "youtube" ){
	  echo '<p class="black-65" id="video-controls">
		  <a class="tubular-play" href="#"><i class="fa fa-play "></i></a>&nbsp; &nbsp;&nbsp;&nbsp;
		  <a class="tubular-pause" href="#"><i class="fa fa-pause "></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		  <a class="tubular-volume-up" href="#"><i class="fa fa-volume-up "></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		  <a class="tubular-volume-down" href="#"><i class="fa fa-volume-off "></i></a> 
	  </p>';
	 }
	
	 ?>
    </section>
 <?php
 
  
	 if( $video_enable == 1 && $video_background_type == "html5" ){
		 if( $video_loop == 1 ){
		$video_loop = "true";
		}
		else{
		$video_loop = "false";	
			}
	
		
		 echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/video.js"></script>';
		 echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/bigvideo.js"></script>';
		 echo '<script type="text/javascript" > 
		    var BV;
            var BV = new jQuery.BigVideo({
				useFlashForFirefox:false,
				forceAutoplay:true,
				controls:false,
				doLoop:'.$video_loop.',
			});
			BV.init();
			if (Modernizr.touch) {
				BV.show("'.$poster_url.'");
			} else {
				BV.show(
				[
        { type: "video/mp4",  src: "'.$mp4_video_url.'" },
        { type: "video/webm", src: "'.$webm_video_url.'" },
        { type: "video/ogg",  src: "'.$ogv_video_url.'" }
    ],{ambient:'.$video_loop.'});
	BV.getPlayer().volume('.$video_volume.');
			}
	  </script>';
	 }
	 
 }
 }
  if($video_array !="" && $video_array != NULL ){
  wp_localize_script( 'onetone-bigvideo', 'onetone_bigvideo',$video_array);
  
		}

 endif;
 ?>
<div class="clear"></div>  
</div>
<?php get_footer();}?>