<?php
	get_header();
	$src = get_template_directory_uri() . '/img/404.png';
	echo '<div class="container wrapper-404">';
	echo '<img src="'.$src.'" class="img-404">';
	echo '<h3 class="text-404">Страница не найдена!</h3>';
	echo '<button class="btn" onclick="window.history.back()">Вернуться</button>';
	echo '</div>';
	get_footer();
?>