	</div>
	<!-- /body -->
	<?php if(is_home()) : ?>					
		<div class="loading">
			<a class="inifiniteLoader">
				<img src="<?php bloginfo('template_directory'); ?>/images/loading.gif">
			</a>	
		</div>
	<?php endif; ?>					
	
	<footer id="footer" class="pagewidth clearfix">
						
		<?php // footer navigation ?>
		<?php wp_nav_menu(array('theme_location' => 'footer-nav' , 'fallback_cb' => '' , 'container'  => '' , 'menu_id' => 'footer-nav' , 'menu_class' => 'footer-nav')); ?>

		<div class="footer-text clearfix">
			<?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?><br>
			Powered by <a href="http://wordpress.org">WordPress</a>  &bull; <a href="http://themify.me">Themify WordPress Themes</a>
		</div>
		<!-- /footer-text --> 

	</footer>
	<!-- /#footer --> 

</div>
<!-- /#pagewrap -->

<!-- wp_footer -->
<?php wp_footer(); ?>

</body>
</html>