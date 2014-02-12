	</div>
	<!-- /body -->
	<?php if(is_home() || is_category()) : ?>					
		<div class="loading">
			<a class="inifiniteLoaderDown">
				<!--<img src="<?php bloginfo('template_directory'); ?>/images/loading.gif">-->
				<img src="<?php bloginfo('template_directory'); ?>/images/ajaxload.gif">
			</a>	
		</div>
	<?php endif; ?>			
</div>
<!-- /#pagewrap -->	
	
<footer id="footer" class="pagewidth clearfix">
					
	<?php // footer navigation ?>
	<?php wp_nav_menu(array('theme_location' => 'footer-nav' , 'fallback_cb' => '' , 'container'  => '' , 'menu_id' => 'footer-nav' , 'menu_class' => 'footer-nav')); ?>

	<div class="footer-text clearfix">
		<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?></p><br>
		<p>Powered by ponte.valerio@gmail.com</p>
	</div>
	<!-- /footer-text --> 

</footer>
<!-- /#footer --> 

<?php		
	//NAVIGATION PER MOBILE	
	require_once (TEMPLATEPATH . '/includes/navigation_mobile.php');		
?>


<!-- wp_footer -->
<?php wp_footer(); ?>

</body>
</html>