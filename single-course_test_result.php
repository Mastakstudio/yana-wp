<?php
get_header();

global $post;

if ( have_posts() ):
	while ( have_posts() ):
//		the_post();
//		var_dump(get_post_meta(get_the_ID()));
//		echo '<br>';
//		var_dump(carbon_get_post_meta(get_the_ID(), TEST_ID));
//		echo '<br>';
//		var_dump(carbon_get_post_meta(get_the_ID(), TEST_COURSE_ID));
//		echo '<br>';
//		var_dump(carbon_get_post_meta(get_the_ID(), TEST_USER_ID));
//		echo '<br>';
//		var_dump(carbon_get_post_meta(get_the_ID(), TEST_ANSWERED));
//		echo '<br>';
//		var_dump(carbon_get_post_meta(get_the_ID(), TEST_RIGHT_ANSWERED));
//		echo '<br>';
//		var_dump(carbon_get_post_meta(get_the_ID(), TEST_STARTED));
//		echo '<br>';
//		var_dump(carbon_get_post_meta(get_the_ID(), TEST_END_TIME));
//		echo '<br>';
//		var_dump(carbon_get_post_meta(get_the_ID(), TEST_START_TIME));
//		echo '<br>';

	endwhile;
endif;
get_footer();
