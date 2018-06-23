<?php
	get_header();
	while (have_posts() ) {
		the_post();
		$category = get_the_category()[0]->slug;

		if( $category == 'video' ) {
			$media = get_field('post_video');
		} else {
			$media = make_img_html(
				get_post_thumbnail_id(),
				array(
					'800' => 'mainStock_Phones',
					'1440' => 'frontPost_720p',
					'1920' => 'frontPost_1080p',
					'2560' => 'frontPost_Retina',
					'4000' => 'frontPost_4K'
				),
				array(
					'800' => '40vw',
					'1440' => '40vw',
					'1920' => '40vw',
					'2560' => '40vw',
					'4000' => '100vw'
				),
				'wp',
				'one-post__image'
			);
		}
?>

<div class="one-post">
	<h2 class="one-post__title"><?= get_the_title() ?></h2>
	<?= $media ?>
	<div class="one-post__text one-post__date"><?= get_the_date() ?></div>
	<div class="one-post__text one-post__content"><?= get_the_content() ?></div>
</div>

<?php
	}
	get_footer();
?>