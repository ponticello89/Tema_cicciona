<?php 
	$nextPost=get_next_post(); 
	$nextPostId=$nextPost->ID;
	$nextPostUrl = get_permalink($nextPostId); 
	echo $nextPostUrl;
?>