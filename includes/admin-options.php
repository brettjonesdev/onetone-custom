<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */
function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option(ONETONE_OPTIONS_PREFIXED.'optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option(ONETONE_OPTIONS_PREFIXED.'optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */


function optionsframework_options() {

	// Background Defaults
	
	
	$page_background = array(
		'color' => '',
		'image' => ONETONE_THEME_BASE_URL.'/images/leftbg.jpg',
		'repeat' => 'no-repeat',
		'position' => 'top left',
		'attachment'=>'fixed' );
	$footer_background = array(
		'color' => '#000',
		'image' => '',
		'repeat' => 'no-repeat',
		'position' => 'top left',
		'attachment'=>'' );
	
	
	$googleFontArray = onetone_options_typography_get_google_fonts();
	
	$onetone_typography_mixed_fonts = array_merge( onetone_options_typography_get_os_fonts() , $googleFontArray['onetone_of_family'] );
        asort($onetone_typography_mixed_fonts);
		
		$nav_typography_defaults = array(
		'size'  => '16px',
		'face'  => 'Calibri,sans-serif',
		'style' => 'normal',
		'color' => '#dddddd' );
		
		$section_title_typography_defaults = array(
		'size'  => '60px',
		'face'  => 'Raleway, sans-serif',
		'style' => '400',
		'color' => '#666666' );
		
		$footer_typography_defaults = array(
		'size'  => '14px',
		'face'  => 'Calibri,sans-serif',
		'style' => 'inherit',
		'color' => '#777777' );
		
		$typography_options = array(
		'sizes'  => array( '10','11','12','13','14','16','18','20','24','26','28','30','35','40','46','50','60' ),
		'faces'  => $onetone_typography_mixed_fonts,
		'styles' => array(
				  'normal' =>  'normal',
				  'italic' => 'italic', 
				  'bold' => 'bold',
				  'bold italic' => 'bold italic',
				  '100' => '100', 
				  '200' =>  '200',
				  '300' => '300',
				  '400' => '400', 
				  '500' =>  '500', 
				  '600' =>  '600', 
				  '700' =>  '700', 
				  '800' =>  '800',
				  '900' =>  '900' 
				  ),
		
		'color'  => true );
		

		
	$font_color          = array('color' =>  '');
	$section_font_color  = array('color' => '');
	$section_title       = array("","About Us","Services","Gallery","Timeline","Contact");
	$section_menu        = array("Home","About Us","Services","Gallery","Timeline","Contact");
	$default_section_num = count($section_menu);
	$section_num         = onetone_options_array('section_num');
	$section_num         = $section_num == ""?6:$section_num;
	$section_background  = array(
	     array(
		'color' => '',
		'image' => ONETONE_THEME_BASE_URL.'/images/home-bg01.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' ),
		 array(
		'color' => '',
		'image' => ONETONE_THEME_BASE_URL.'/images/home-bg02.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' ),
		 array(
		'color' => '',
		'image' => ONETONE_THEME_BASE_URL.'/images/home-bg04.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' ),
		 array(
		'color' => '',
		'image' => ONETONE_THEME_BASE_URL.'/images/home-bg02.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' ),
		 array(
		'color' => '',
		'image' => ONETONE_THEME_BASE_URL.'/images/home-bg03.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' ),
		 array(
		'color' => '',
		'image' => ONETONE_THEME_BASE_URL.'/images/home-bg02.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' )
			);
	$section_css_class = array("section-banner","section-about","","","","");
	
	
	$section_content   = array('<div class="banner-box"><br/><br/><br/><br/>
<h1>TARAY BOGRILOYAT srians</h1>
<span>CRAS URNA LEO, FRINGILLA NEC ALIQUAM AC, VARIUS IN ENIM. MAECENAS NON FELIS AUGUE,
QUIS SAGITTIS JUSTO. DONEC GRAVIDA, ARCU IN ALIQUET CONVALLIS</span>
<div class="banner-scroll"><a href="#about-us"><img src="'.ONETONE_THEME_BASE_URL.'/images/down.png" alt="" /></a></div>
<ul class="banner-sns">
	<li><a href="#"><i class="fa fa-2 fa-facebook"></i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-skype"></i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-twitter"></i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-linkedin"></i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-google-plus"></i></a></li>
	<li><a href="#"><i class="fa fa-2 fa-rss"></i></a></li>
</ul>
</div>',
			'[row]
  [column col_sm="8"] 
            	<h3>Biography</h3>
                <p>Morbi rutrum, elit ac fermentum egestas, tortor ante vestibulum est, eget 
					scelerisque nisl velit eget tellus. Fusce porta facilisis luctus. Integer neque 
					dolor, rhoncus nec euismod eget, pharetra et tortor. Nulla id pulvinar nunc. 
					Vestibulum auctor nisl vel lectus ullamcorper sed pellentesque dolor 
					eleifend. Praesent lobortis magna vel diam mattis sagittis.Mauris porta odio 
					eu risus scelerisque id facilisis ipsum dictum vitae volutpat. Lorem ipsum 
					dolor sit amet, consectetur adipiscing elit. Sed pulvinar neque eu purus 
					sollicitudin et sollicitudin dui ultricies. Maecenas cursus auctor tellus sit 
					amet blandit. Maecenas a erat ac nibh molestie interdum. Class aptent 
					taciti sociosqu ad litora torquent per conubia nostra, per inceptos 
					himenaeos. Sed lorem enim, ultricies sed sodales id, convallis molestie 
					ipsum. Morbi eget dolor ligula. Vivamus accumsan rutrum nisi nec 
					elementum. Pellentesque at nunc risus. Phasellus ullamcorper 
					bibendum varius. Quisque quis ligula sit amet felis ornare porta. Aenean 
					viverra lacus et mi elementum mollis. Praesent eu justo elit.</p>
			[/column]
           [column col_sm="4"] 
            	<h3>Personal Info</h3>
                <ul>
                	<li class="info-phone">+1123 2456 689</li>
					<li class="info-address">3301 Lorem Ipsum, Dolor Sit St</li>
					<li class="info-email"><a href="#">support@mageewp.com. </a></li>
					<li class="info-website"><a href="#">Mageewp.com</a></li>
                </ul>                	
            [/column]
			[/row]',
			"[row]
[column col_sm='4']
[animation animation_speed='1.5' animation_type='bounce' image_animation='yes' ]
[service title='FEATURE 1' icon='fa-comments-o' ]Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.[/service]
[/animation]
[/column]

[column col_sm='4']
[animation animation_speed='1.5' animation_type='shake' image_animation='yes' ]
[service title='FEATURE 2' icon='fa-star-half-empty' ]Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.[/service]
[/animation]
[/column]

[column col_sm='4']
[animation animation_speed='1.5' animation_type='fade-down' image_animation='yes']
[service title='FEATURE 3' icon='fa-cog fa-spin' ]Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.[/service]
[/animation]
[/column]
[/row]",
			'<p>Use wordpress core gallery shortcode and add attribute  rel="lightbox-group" size="medium" link="file".  e.g. [gallery rel="lightbox-group" size="medium" link="file" ids="3463,3468,3469,3521,3522,3523"]</p>
			<div class="portfolio-list">
        		<ul>
            		<li><a href="#"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g1.jpg"></a></li>
                	<li><a href="#"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g2.jpg"></a></li>
               		<li><a href="#"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g3.jpg"></a></li>
               		<li><a href="#"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g4.jpg"></a></li>
               		<li><a href="#"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g5.jpg"></a></li>
               		<li><a href="#"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g6.jpg"></a></li>
               		<li><a href="#"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g7.jpg"></a></li>
                	<li><a href="#"><img class="port-img" src="'.ONETONE_THEME_BASE_URL.'/images/g8.jpg"></a></li>
            	</ul>
        	</div>
			
			',
			'[timeline num="3" excerpt_length="60" ]',
			
			'<p class="contact-text">INTEGER ALIQUET ARCU SIT AMET SEM PORTA FACILISIS. CURABITUR SAPIEN SAPIEN, 
				BLANDIT IN MOLESTIE ET, SAGITTIS ID LOREM. NULLA MALESUADA MAURIS ID TURPIS</p>
		
			 [contact style="3" email="admin@admin.com"]			 
			'
	);
	//$section_background_video = array("ab0TSkLe-E0","","","","","");

	$options = array();
   // HEADER
	$options[] = array(
		'name' => __('General Options', 'onetone'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Favicon', 'onetone'),
		'desc' => __('An icon associated with a URL that is variously displayed, as in a browser\'s address bar or next to the site name in a bookmark list. Learn more about 
					 <a href="'.esc_url("http://en.wikipedia.org/wiki/Favicon").'" target="_blank">Favicon</a>', 'onetone'),
		'id' => 'favicon',
		'type' => 'upload');
		
		$options[] = array(
		'name' =>  __('Post & Page Background', 'onetone'),
		'id' => 'page_background',
		'std' => $page_background,
		'type' => 'background' );
		
			
/*	$options[] = array(
		'name' =>  __('Header Menu Font Color', 'onetone'),
		'id' => 'font_color',
		'std' => '',
		'type' => 'color' );*/
		
		
	$options[] = array(
		'name' => __('Custom CSS', 'onetone'),
		'desc' => __('The following css code will add to the header before the closing &lt;/head&gt; tag.', 'onetone'),
		'id' => 'custom_css',
		'std' => 'body{margin:0px;}',
		'type' => 'textarea');
	
	////Header
		$options[] = array(
		'name' => __('Header', 'onetone'),
		'type' => 'heading');
	    
		$options[] = array(
		'name' => __('Upload Logo', 'onetone'),
		'id' => 'logo',
		'std' => '',
		'type' => 'upload');
		
		$options[] = array(
		'name' => __('Header Opacity', 'onetone'),
		//'desc' => __('', 'onetone'),
		'id' => 'header_opacity',
		'std' => '0.8',
		'class' => 'mini',
		'options' => array_combine(range(0.1,1,0.1), range(0.1,1,0.1)),
		'type' => 'select');
			
		
		$options[] = array(
		'name' => __('Homepage Nav Menu Typography', 'onetone'),
		'id'   => "homepage_nav_typography",
		'std'  => $nav_typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );
		
		////Footer
		$options[] = array(
		'name' => __('Footer', 'onetone'),
		'type' => 'heading');
		
		$options[] = array(
		'name' => __('Footer Typography', 'onetone'),
		'id'   => "footer_typography",
		'std'  => $footer_typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );
		
		$options[] = array(
		'name' =>  __('Footer Background', 'onetone'),
		'id' => 'footer_background',
		'std' => $footer_background,
		'type' => 'background' );
		
	    $options[] = array(
		'name' => __('Copyright', 'onetone'),
		'desc' => __('Copyright text.', 'onetone'),
		'id' => 'copyright',
		'std' => 'Copyright &copy; '.date('Y').', Designed by <a href="'.esc_url("http://www.mageewp.com/").'">MageeWP Themes</a>.',
		'type' => 'textarea');
		
		////HOME PAGE
		$options[] = array(
		'name' => __('Home Page', 'onetone'),
		'type' => 'heading');
		
		//HOME PAGE SECTION
		
	   $options[] = array(
		'name' => __('Content Sections Num', 'onetone'),
		'desc' => __('The number of home page sections.', 'onetone'),
		'id' => 'section_num',
		'std' => '6',
		'type' => 'text');
	   
	    $options[] = array('name' => __('HTML5 Video Background Options', 'onetone'),'id' => 'html5_video_options','type' => 'start_group','class'=>'group_close');
		
		$options[] = array('name' => __('mp4 video url', 'onetone'),'id' => 'mp4_video_url','type' => 'text','std'=>'' ,"desc"=>__('For Android devices, Internet Explorer 9, Safari','onetone'));
		$options[] = array('name' => __('ogv video url', 'onetone'),'id' => 'ogv_video_url','type' => 'text','std'=>'',"desc"=>__('For Google Chrome, Mozilla Firefox, Opera ','onetone'));
		$options[] = array('name' => __('webm video url', 'onetone'),'id' => 'webm_video_url','type' => 'text','std'=>'',"desc"=>__('For Google Chrome, Mozilla Firefox, Opera ','onetone'));
		$options[] = array('name' => __('poster', 'onetone'),'id' => 'poster_url','type' => 'upload','std'=>'',"desc"=>__('Displaying the image for browsers that don\'t support the HTML5 Video element.','onetone'));
		$options[] = array(	'name' => __('Video Loop', 'onetone'),	'id' => 'video_loop','std' => '1','class' => 'mini','options' => array('1'=>'yes','0'=>'no'),	'type' => 'select');
		$options[] = array(	'name' => __('Video Volume', 'onetone'),	'id' => 'video_volume','std' => '0.8','class' => 'mini','options' => array('0.001'=>'0','0.1'=>'0.1','0.2'=>'0.2','0.3'=>'0.3','0.4'=>'0.4','0.5'=>'0.5','0.6'=>'0.6','0.7'=>'0.7','0.8'=>'0.8','0.9'=>'0.9','1.0'=>'1.0'),	'type' => 'select');
		
		
		$options[] = array('name' => '','id' => 'html5_video_options_end','type' => 'end_group');
		
	   
	   $options[] = array('name' => __('YouTube Video Background Options', 'onetone'),'id' => 'youtube_video_options','type' => 'start_group','class'=>'group_close');
		
		$options[] = array('name' => __('Section Background Video', 'onetone'),'std' => 'ab0TSkLe-E0','desc' => __('YouTube Video ID', 'onetone'),'id' => 'section_background_video_0',
		'type' => 'text');
		
		$options[] = array(	'name' => __('Video Controls', 'onetone'),'desc' => __('Display video control buttons.', 'onetone'),'id' => 'video_controls','std' => '1','class' => 'mini','options' => array('1'=>'yes','0'=>'no'),'type' => 'select');
		
		$options[] = array('name' => '','id' => 'youtube_video_options_end','type' => 'end_group');
		
		$options[] = array(	'name' => __('Video Background Type', 'onetone'),	'id' => 'video_background_type','std' => 'youtube','class' => 'mini','options' => array('youtube'=>'YouTube Video','html5'=>'HTML5 Video'),	'type' => 'select');
		
		$video_background_section = array("0"=>"No video background");
		if( is_numeric( $section_num ) ){
		for($i=1; $i <= $section_num; $i++){
			$video_background_section[$i] = "Secion ".$i;
			}
		}
		$options[] = array('name' => __('Video Background Section', 'onetone'),'std' => '1','id' => 'video_background_section',
		'type' => 'select','options'=>$video_background_section);
		
		
		$options[] = array('name' => __('Section 1 Content', 'onetone'),'std' => 'content','id' => 'section_1_content',
		'type' => 'select','options'=>array("content"=>"Content","slider"=>"Slider"));
		
	  
		$options[] = array(
		'name' => __('Section Title Typography', 'onetone'),
		'id'   => "section_title_typography",
		'std'  => $section_title_typography_defaults,
		'type' => 'typography',
		'options' => $typography_options );
		
		
		if(isset($section_num) && is_numeric($section_num) && $section_num>0){
		$section_num = $section_num;
		}
		else{
		$section_num = $default_section_num;
		}
	
		for($i=0; $i < $section_num; $i++){
		
		if(!isset($section_title[$i])){$section_title[$i] = "";}
		if(!isset($section_menu[$i])){$section_menu[$i] = "";}
		if(!isset($section_background[$i])){$section_background[$i] = array('color' => '',
		'image' => '',
		'repeat' => '',
		'position' => '',
		'attachment'=>'');}
		if(!isset($section_css_class[$i])){$section_css_class[$i] = "";}
		if(!isset($section_content[$i])){$section_content[$i] = "";}
		
		$options[] = array('name' => sprintf(__('Section %s', 'onetone'),($i+1)),'id' => 'section_group_start_'.$i.'','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Section Title', 'onetone'),'id' => 'section_title_'.$i.'','type' => 'text','std'=>$section_title[$i]);
		$options[] = array(	'name' =>  __('Section Title Color', 'onetone'),	'id' => 'section_title_color_'.$i.'', 'std' => '',	'type' => 'color' );
		
		$options[] = array('name' => __('Menu Title', 'onetone'),'id' => 'menu_title_'.$i.'','type' => 'text','std'=>$section_menu[$i],'desc'=>'This title will display in the header menu. It is required');
		$options[] = array('name' => __('Menu Slug', 'onetone'),'id' => 'menu_slug_'.$i.'','type' => 'text','std'=>'','desc'=>'The  "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.');
		
		$options[] = array('name' =>  __('Section Background', 'onetone'),'id' => 'section_background_'.$i.'','std' => $section_background[$i],'type' => 'background' );
		
		$options[] = array('name' => __('100% Width Background Image', 'onetone'),'std' => 'no','id' => 'background_size_'.$i.'',
		'type' => 'select','class'=>'mini','options'=>array("no"=>"no","yes"=>"yes"));
		
		$options[] = array('name' => __('Parallax Scrolling Background Image', 'onetone'),'std' => 'no','id' => 'parallax_scrolling_'.$i.'',
		'type' => 'select','class'=>'mini','options'=>array("no"=>"no","yes"=>"yes"));
		
		
		$options[] = array('name' => __('Full Width', 'onetone'),'std' => 'no','id' => 'full_width_'.$i.'',
		'type' => 'select','class'=>'mini','options'=>array("no"=>"no","yes"=>"yes"));
		
		$options[] = array('name' => __('Section Css Class', 'onetone'),'id' => 'section_css_class_'.$i.'','type' => 'text','std'=>$section_css_class[$i]);
	   
	  
	   
	   $options[] = array('name' => __('Section Content', 'onetone'),'id' => 'section_content_'.$i,'std' => $section_content[$i],'type' => 'editor');
	
		$options[] = array('name' => '','id' => 'section_group_end_'.$i.'','type' => 'end_group');
		
		}

		//END HOME PAGE SECTION
		
			// Slider
		$options[] = array(	'name' => __('Slider', 'onetone'),'type' => 'heading');
				
		//HOME PAGE SLIDER
		$options[] = array('name' => __('Slideshow', 'onetone'),'id' => 'group_title','type' => 'title');
		
		$options[] = array('name' => __('Slide 1', 'onetone'),'id' => 'slide_group_start_1','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'onetone'),'id' => 'onetone_slide_image_1','type' => 'upload','std'=>ONETONE_THEME_BASE_URL.'/images/banner-1.jpg');
		//$options[] = array('name' => __('Title', 'onetone'),'id' => 'onetone_slide_title_1','type' => 'text','std'=>'Title 1');

		$options[] = array('name' => __('Text', 'onetone'),'id' => 'onetone_slide_text_1','type' => 'editor','std'=>'<h1>The jQuery slider that just slides.</h1><p>No fancy effects or unnecessary markup.</p><a class="btn" href="#download">Download</a>');
		//$options[] = array('name' => __('Link', 'onetone'),'id' => 'onetone_slide_link_1','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_1','type' => 'end_group');
		
		$options[] = array('name' => __('Slide 2', 'onetone'),'id' => 'slide_group_start_2','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'onetone'),'id' => 'onetone_slide_image_2','type' => 'upload','std'=>ONETONE_THEME_BASE_URL.'/images/banner-2.jpg');
		//$options[] = array('name' => __('Title', 'onetone'),'id' => 'onetone_slide_title_2','type' => 'text','std'=>'Title 2');
		$options[] = array('name' => __('Text', 'onetone'),'id' => 'onetone_slide_text_2','type' => 'editor','std'=>'<h1>Fluid, flexible, fantastically minimal.</h1><p>Use any HTML in your slides, extend with CSS. You have full control.</p><a class="btn" href="#download">Download</a>');
		//$options[] = array('name' => __('Link', 'onetone'),'id' => 'onetone_slide_link_2','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_2','type' => 'end_group');
		
		$options[] = array('name' => __('Slide 3', 'onetone'),'id' => 'slide_group_start_3','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'onetone'),'id' => 'onetone_slide_image_3','type' => 'upload','std'=>ONETONE_THEME_BASE_URL.'/images/banner-3.jpg');
		//$options[] = array('name' => __('Title', 'onetone'),'id' => 'onetone_slide_title_3','type' => 'text');
		$options[] = array('name' => __('Text', 'onetone'),'id' => 'onetone_slide_text_3','type' => 'editor','std'=>'<h1>Open-source.</h1><p> Vestibulum auctor nisl vel lectus ullamcorper sed pellentesque dolor eleifend.</p><a class="btn" href="#">Contribute</a>');
		//$options[] = array('name' => __('Link', 'onetone'),'id' => 'onetone_slide_link_3','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_3','type' => 'end_group');
		
		$options[] = array('name' => __('Slide 4', 'onetone'),'id' => 'slide_group_start_4','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'onetone'),'id' => 'onetone_slide_image_4','type' => 'upload','std'=>ONETONE_THEME_BASE_URL.'/images/banner-4.jpg');
		//$options[] = array('name' => __('Title', 'onetone'),'id' => 'onetone_slide_title_4','type' => 'text');
		$options[] = array('name' => __('Text', 'onetone'),'id' => 'onetone_slide_text_4','type' => 'editor','std'=>'<h1>Uh, that\'s about it.</h1><p>I just wanted to show you another slide.</p><a class="btn" href="#download">Download</a>');
		//$options[] = array('name' => __('Link', 'onetone'),'id' => 'onetone_slide_link_4','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_4','type' => 'end_group');
		
		$options[] = array('name' => __('Slide 5', 'onetone'),'id' => 'slide_group_start_5','type' => 'start_group','class'=>'group_close');
		$options[] = array('name' => __('Image', 'onetone'),'id' => 'onetone_slide_image_5','type' => 'upload');
	  //$options[] = array('name' => __('Title', 'onetone'),'id' => 'onetone_slide_title_5','type' => 'text');
		$options[] = array('name' => __('Text', 'onetone'),'id' => 'onetone_slide_text_5','type' => 'editor');
	  //$options[] = array('name' => __('Link', 'onetone'),'id' => 'onetone_slide_link_5','type' => 'text');
		$options[] = array('name' => '','id' => 'slide_group_end_5','type' => 'end_group');
		

	/*	$options[] = array(
		'name' => __('Slide Height', 'onetone'),
		'id' => 'slide_height',
		'std' => '30%',
		'desc'=>__('Both formats: Percentage or Pixel(e.g. "30%" or "400px").','onetone'),
		'type' => 'text');	*/
		
		$options[] = array(
		'name' => __('Slide Time', 'onetone'),
		'id' => 'slide_time',
		'std' => '5000',
		'desc'=>__('Milliseconds between the end of the sliding effect and the start of the nex one.','onetone'),
		'type' => 'text');		
		
		//END HOME PAGE SLIDER
		
	return $options;
}

