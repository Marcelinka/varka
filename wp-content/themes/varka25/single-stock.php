<?php 
	get_header();
	while (have_posts() ) {
		the_post();
?>

<section class="one-stock">
	<h2 class="one-stock__title"><?= get_field('stock_preview_title') ?></h2>
	<div class="all-stock__line"></div>
	<div class="one-stock__subtitle"><?= get_field('stock_preview_text') ?></div>
	<?= make_img_html(
			get_field('stock_photo'),
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
			'acf',
			'all-image one-stock__image'
		) ?>
	<div class="one-stock__text"><?= get_field('stock_description') ?></div>
</section>

<?php 
	}
	get_footer(); 
?>