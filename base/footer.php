	</div>
	<!-- /body -->
		
	<footer id="footer" class="pagewidth clearfix">
			
		<p class="back-top"><a href="#header">&uarr;</a></p>
	
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

<a id="inifiniteLoader">Loading... <img src="<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif"></a>

<script type="text/javascript">
//reSizeDivImage();
</script>

</body>
</html>