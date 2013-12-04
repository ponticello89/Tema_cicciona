<?php 
	$prevPost=get_previous_post(); 
	$prevPostId=$prevPost->ID;
	$prevPostUrl = get_permalink($prevPostId); 
	echo $prevPostUrl;
?>