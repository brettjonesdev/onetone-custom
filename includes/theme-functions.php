<?php

 	/*	
	*	get background 
	*	---------------------------------------------------------------------
	*/
function onetone_get_background($args){
$background = "";
 if (is_array($args)) {
	if (isset($args['image']) && $args['image']!="") {
	$background =  "background:url(".$args['image']. ")  ".$args['repeat']." ".$args['position']." ".$args['attachment'].";";
	}

	if(isset($args['color']) && $args['color'] !=""){
	$background = "background-color:".$args['color'].";";
	}

	}
return $background;
}



 	/*	
	*	send email
	*	---------------------------------------------------------------------
	*/
function onetone_contact(){
	if(trim($_POST['Name']) === '') {
		$Error = __('Please enter your name.','onetone');
		$hasError = true;
	} else {
		$name = trim($_POST['Name']);
	}

	if(trim($_POST['Email']) === '')  {
		$Error = __('Please enter your email address.','onetone');
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['Email']))) {
		$Error = __('You entered an invalid email address.','onetone');
		$hasError = true;
	} else {
		$email = trim($_POST['Email']);
	}

	if(trim($_POST['Message']) === '') {
		$Error =  __('Please enter a message.','onetone');
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['Message']));
		} else {
			$message = trim($_POST['Message']);
		}
	}

	if(!isset($hasError)) {
	   if (isset($_POST['sendto']) && preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['sendto']))) {
	     $emailTo = $_POST['sendto'];
	   }
	   else{
	 	 $emailTo = get_option('admin_email');
		}
		 if($emailTo !=""){
		$subject = 'From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
		}
		echo json_encode(array("msg"=>__("Your message has been successfully sent!","onetone"),"error"=>0));
		
	}
	else
	{
	echo json_encode(array("msg"=>$Error,"error"=>1));
	}
	die() ;
	}
	add_action('wp_ajax_onetone_contact', 'onetone_contact');
	add_action('wp_ajax_nopriv_onetone_contact', 'onetone_contact');
	
	// get breadcrumbs
 function onetone_get_breadcrumb(){
   global $post;
   $show_breadcrumb = "";
   
   if(isset($post->ID) && is_numeric($post->ID)){
    $show_breadcrumb = get_post_meta( $post->ID, '_onetone_show_breadcrumb', true );
	}
	if($show_breadcrumb == 1 || $show_breadcrumb==""){

     new onetone_breadcrumb;

	}
	}
	
	
/*
*  page navigation
*
*/
function onetone_native_pagenavi($echo,$wp_query){
    if(!$wp_query){global $wp_query;}
    global $wp_rewrite;      
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'prev_text' => '&laquo; ',
    'next_text' => ' &raquo;'
    );
 
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
 
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
    if($echo == "echo"){
    echo '<div class="page_navi">'.paginate_links($pagination).'</div>'; 
	}else
	{
	
	return '<div class="page_navi">'.paginate_links($pagination).'</div>';
	}
}
   
    //// Custom comments list
   
   function onetone_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ;?>">
     <div id="comment-<?php comment_ID(); ?>">
	 
	 <div class="comment-avatar"><?php echo get_avatar($comment,'52','' ); ?></div>
			<div class="comment-info">
			<div class="reply-quote">
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
			</div>
      <div class="comment-author vcard">
        
			<span class="fnfn"><?php printf(__('%s </cite><span class="says">says:</span>','onetone'), get_comment_author_link()) ;?></span>
								<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">
<?php printf(__('%1$s at %2$s','onetone'), get_comment_date(), get_comment_time()) ;?></a>
<?php edit_comment_link(__('(Edit)','onetone'),'  ','') ;?></span>
				<span class="comment-meta">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">-#<?php echo $depth?></a>				</span>

      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.','onetone') ;?></em>
         <br />
      <?php endif; ?>

     

      <?php comment_text() ;?>
</div>
   <div class="clear"></div>
     </div>
<?php
        }

/*
*  register favicon
*
*/

 add_action( 'wp_head', 'onetone_favicon' );

	function onetone_favicon()
	{
	    $url =  onetone_options_array('favicon');
	
		$icon_link = "";
		if($url)
		{
			$type = "image/x-icon";
			if(strpos($url,'.png' )) $type = "image/png";
			if(strpos($url,'.gif' )) $type = "image/gif";
		
			$icon_link = '<link rel="icon" href="'.esc_url($url).'" type="'.$type.'">';
		}
		
		echo $icon_link;
	}
	

/*
*  onetone slider
*
*/

	function onetone_get_default_slider(){
	
	$sanitize_title = "home";
	$section_menu   = onetone_options_array( 'menu_title_0' );
	$section_slug   = onetone_options_array( 'menu_slug_0' );
	if( $section_menu  != "" ){
    $sanitize_title = sanitize_title($section_menu );
    if( trim($section_slug) !="" ){
	 $sanitize_title = sanitize_title($section_slug); 
	 }
 }

	 
	$return = '<section id="'.$sanitize_title.'" class="section homepage-slider onetone-'.$sanitize_title.'"><div id="owl-demo" class="owl-carousel owl-theme">';
	 for($i=1;$i<=5;$i++){
	$active = '';
	
	 $text       = onetone_options_array('onetone_slide_text_'.$i);
	 $image      = onetone_options_array('onetone_slide_image_'.$i);
	
     if( $image != "" ){
      $return .= '<div class="item"><img src="'.$image.'" alt=""><div class="inner">'. $text .'</div></div>';
	 }

	}
	
		$return .= '</div></section>';

        return $return;
   }
   

	 
/*
*  wp_title filter
*
*/

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

	 
/*
*  title filter
*
*/

function onetone_title( $title ) {
if ( $title == '' ) {
  return 'Untitled';
  } else {
  return $title;
  }
}
add_filter( 'the_title', 'onetone_title' );


// ################################## fonts family
   /**
 * Returns an array of system fonts
 */
 
function onetone_options_typography_get_os_fonts() {
    // OS Font Defaults
    $os_faces = array(
            'Arial, sans-serif' => 'Arial',
	        '"Avant Garde", sans-serif' => 'Avant Garde',
	        'Cambria, Georgia, serif' => 'Cambria',
			'Calibri,sans-serif' => 'Calibri' ,
	        'Copse, sans-serif' => 'Copse',
	        'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
	        'Georgia, serif' => 'Georgia',
	        '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
	        'Tahoma, Geneva, sans-serif' => 'Tahoma'
	    );
	    return $os_faces;
	}
	
	
	/**
 * Returns a select list of Google fonts
 * Feel free to edit this, update the fallbacks, etc.
 */
 
function onetone_options_typography_get_google_fonts() {
    // Google Font Defaults
	
	global $google_fonts_json;
	
	$googleFontArray = array();

   $fontArray = json_decode($google_fonts_json, true);
   
   foreach($fontArray['items'] as $index => $value){
	   
   $_family = strtolower( str_replace(' ','_',$value['family']) );
   $googleFontArray[$_family]['family'] = $value['family'];
   $googleFontArray[$_family]['variants'] = $value['variants'];
   $googleFontArray[$_family]['subsets'] = $value['subsets'];
 
   $category = '';
   if( isset($value['category']) ) $category = ', '.$value['category'];
   $googleFontArray['onetone_of_family'][$value['family'].$category] = $value['family'];
   
   }
   	    return $googleFontArray;
	}
	
/*
*  get typography
*
*/

	
function onetone_options_typography_enqueue_google_font($font) {
	
	   $googleFontArray       = onetone_options_typography_get_google_fonts() ;
	   $googleFontFamilyArray = array() ;
	   foreach($googleFontArray['onetone_of_family'] as $k => $v){
		   $googleFontFamilyArray[] = $k;
		   }
	   if( in_array( $font , $googleFontFamilyArray ) ){
	    $font = explode(',', $font);
	    $font = $font[0];
		$_font_add_string = '';
		$_family = strtolower( str_replace(' ','_',$font) );
		
		if(count( $googleFontArray[$_family]['variants'] )) $_font_add_string = ":". implode(',', $googleFontArray[$_family]['variants']);
		
	    $font = str_replace(" ", "+", $font);
	    wp_enqueue_style( "onetone-typography-$_family", esc_url("//fonts.googleapis.com/css?family=$font" . $_font_add_string), false, null, 'all' );
	   }
		
}


 function onetone_get_typography( $option= array() ){
	 
	 $return = "";
	 if( $option && is_array($option) ){
	 if($option['face']){
	 $return .= 'font-family:'.$option['face'].';' ;
	 onetone_options_typography_enqueue_google_font($option['face']);
	 }
	 if($option['size'])
	 $return .= 'font-size:'.$option['size'].';' ;
	 if($option['style'])
	 $return .= 'font-weight:'.$option['style'].';' ;
	 if($option['color'])
	 $return .= 'color:'.$option['color'].';' ;
		 }
		 
	return $return ;
	 
	 }
	 


function onetone_of_recognized_font_styles() {
	  $default = array(
	'normal' => 'normal',
	'italic' =>  'italic',
	'bold' =>  'bold',
	'bold italic' =>  'bold italic',
	'100' =>  '100',
	'200' =>  '200',
	'300' =>  '300',
	'400' =>  '400',
	'500' =>  '500',
	'600' =>  '600',
	'700' =>  '700',
	'800' =>  '800',
	'900' =>  '900'
  );
	return apply_filters( 'onetone_of_recognized_font_styles', $default );
}
add_filter( 'of_recognized_font_styles', 'onetone_of_recognized_font_styles' );
//###################################


		// fix shortcode

 function onetone_fix_shortcodes($content){   
			$replace_tags_from_to = array (
				'<p>[' => '[', 
				']</p>' => ']', 
				']<br />' => ']',
				']<br>' => ']',
				']\r\n' => ']',
				']\n' => ']',
				']\r' => ']',
				'\r\n[' => '[',
			);

			return strtr( $content, $replace_tags_from_to );
		}

 function onetone_the_content_filter($content) {
	  $content = onetone_fix_shortcodes($content);
	  return $content;
	}
	
add_filter( 'the_content', 'onetone_the_content_filter' );

// cover excerpt length
 function onetone_get_excerpt($count,$postid){
  $permalink = get_permalink($postid);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.'[...]';
  return $excerpt;
}

// cover content length
 function onetone_cover_content($count,$content){
  $content = substr($content, 0, $count);
  $content = substr($content, 0, strripos($content, " "));
  $content = $content.'[...]';
  return $content;
}


function onetone_tinymce_config( $init ) {


	// IFRAME
	$valid_iframe = 'iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width],span[class|id|title|style],a[href],ul[id|class|style],br,p';

	// Add to extended_valid_elements if it alreay exists
	if ( isset( $init['extended_valid_elements'] ) ) {
		$init['extended_valid_elements'] .= ',' . $valid_iframe;
	} else {
		$init['extended_valid_elements'] = $valid_iframe;
	}

// Pass $init back to WordPress
	return $init;
}
add_filter('tiny_mce_before_init', 'onetone_tinymce_config');


   /**
 * onetone admin sidebar
 */
 
   add_action( 'optionsframework_sidebar','onetone_options_panel_sidebar' );

function onetone_options_panel_sidebar() { ?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
	    	<div class="postbox">
	    		<h3><?php _e( 'Quick Links', 'onetone' ); ?></h3>
      			<div class="inside"> 
		          <ul>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/themes/' ); ?>" target="_blank">MageeWP Themes</a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/documents/tutorials' ); ?>" target="_blank">Tutorials</a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/documents/faq/' ); ?>" target="_blank">FAQ</a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/knowledges/' ); ?>" target="_blank">Knowledge</a></li>
                  <li><a href="<?php echo esc_url( 'http://www.mageewp.com/forums/onetone/' ); ?>" target="_blank">Support Forums</a></li>
                  </ul>
      			</div>
	    	</div>
	  	</div>
	</div>
    <div class="clear"></div>
<?php
}