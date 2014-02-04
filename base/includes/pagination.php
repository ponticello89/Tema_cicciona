<?php if(function_exists('themify_pagenav')){ ?>
	<?php themify_pagenav(); ?> 
<?php } else { ?>
	<div class="post-nav">
		<span class="prev">
			<?php 			
			echo str_replace("<a ", "<a rel=\"next\" ", get_next_posts_link(__('&laquo; Older Entries', 'themify')));
			?>
		</span>
		<span class="next">
			<?php 			
			echo str_replace("<a ", "<a rel=\"prev\" ", get_previous_posts_link(__('Newer Entries &raquo;', 'themify')));
			?>
		</span>
	</div>
<?php } ?>