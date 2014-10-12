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
	
	$slide_time = onetone_options_array("slide_time");
	$slide_time = is_numeric($slide_time)?$slide_time:"5000";
	 wp_localize_script( 'onetone-default', 'slide_time',$slide_time);
	 
	$return = '<section id="'.$sanitize_title.'" class="section homepage-slider onetone-'.$sanitize_title.'"><ul>';
	 for($i=1;$i<=5;$i++){
	$active = '';
	
	 $text       = onetone_options_array('onetone_slide_text_'.$i);
	 $image      = onetone_options_array('onetone_slide_image_'.$i);
	
     if( $image != "" ){
     $return .= '<li style="background-image: url(\''.$image.'\');">
					<div class="inner">
						'. $text .'
					</div>
				</li>';
	 }

	}
	
		$return .= '</ul></section>';

        return $return;
   }