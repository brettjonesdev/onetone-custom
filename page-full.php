<?php
/**
* Template Name: Full Width Template
*
*/
   get_header("template"); 

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