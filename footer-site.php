<footer class="site-footer footer">
		<div class="site-info footer-copyright">
        	<?php 
			$copyright = onetone_options_array( 'copyright' );
			echo $copyright;
			?>
		</div>
	</footer>
</div>
<?php
	wp_footer();
?>
</body>
</html>