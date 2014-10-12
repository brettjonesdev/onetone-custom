<?php
/**
* Template Name: One Page Template
*
*/
   get_header("onepage"); 

?>
<div id="post-<?php the_ID(); ?>" <?php post_class("clear"); ?>>
<?php if (have_posts()) :
		  while ( have_posts() ) : the_post();
		 
		 the_content();
		   endwhile;
		 endif;
		 
		  ?>
</div>
<?php get_footer(); ?>