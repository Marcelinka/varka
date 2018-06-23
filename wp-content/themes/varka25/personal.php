<?php

/*
	Template Name: Text page
*/

get_header();

echo '<div class="container text-page" style="padding-top: 60px; padding-bottom: 60px;">';
while(have_posts()) {
	the_post();
	echo '<h2 style="text-align: center;">' . get_the_title() . '</h2>';
	the_content();
}
echo '</div>';

get_footer();