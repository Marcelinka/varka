<?php

/*
	Template Name: Магазин
*/

get_header(); ?>

<section class="description">
	<div class="description__address-phones hidden hidden_phones"><?= get_field('global_address', 'options') ?></div>
	<div class="description__master">
		<?= make_img_html(
				get_field('shop_photo'),
				array(
					'1920' => 'shopMaster_1080p',
					'4000' => 'shopMaster_4K'
				),
				array(
					'1920' => '22vw',
					'4000' => '22vw'
				),
				'acf',
				'all-image'
			) ?>
		<h2 class="description__name"><?= get_field('shop_name') ?></h2>
		<div class="description__position"><?= get_field('shop_position') ?></div>
	</div>
	<div class="description__text">
		<h2>Шоурум</h2>
		<div class="description__details"><?= get_field('shop_description') ?></div>
		<div class="footer__address description__address"><?= get_field('global_address', 'options') ?></div>
		<button class="btn back-call-button footer__button description__button">Обратный звонок</button>
	</div>
</section>

<section class="photogallery container">
	<?php
		while ( have_rows('shop_gallery') ) : the_row();
			$image = make_img_html(
				get_sub_field('shop_gallery_photo'),
				array(
					'800' => 'mainStock_Phones',
					'1440' => 'frontPost_720p',
					'1920' => 'frontPost_1080p',
					'2560' => 'shopGallery_Retina',
					'4000' => 'shopGallery_4K'
				),
				array(
					'800' => '100vw',
					'1440' => '40vw',
					'1920' => '40vw',
					'2560' => '40vw',
					'4000' => '40vw'
				),
				'acf',
				'all-image'
			);
			$imageBig = get_sub_field('shop_gallery_photo')['url'];
			echo '<a class="photogallery__item" href="' . $imageBig . '" data-fancybox="shop-gallery">' . $image . '</a>';
		endwhile; 
	?>
</section>

<section class="photogallery-carousel hidden hidden_phones">
	<div class="owl-carousel owl-theme owl-carousel-shop">
		<?php
			while ( have_rows('shop_gallery') ) : the_row();
				$image = make_img_html(
					get_sub_field('shop_gallery_photo'),
					array(
						'800' => 'mainStock_Phones',
						'1440' => 'frontPost_720p',
						'1920' => 'frontPost_1080p',
						'2560' => 'shopGallery_Retina',
						'4000' => 'shopGallery_4K'
					),
					array(
						'800' => '100vw',
						'1440' => '40vw',
						'1920' => '40vw',
						'2560' => '40vw',
						'4000' => '40vw'
					),
					'acf',
					'photogallery__item'
				);
				echo $image;
			endwhile;
		?>
	</div>
</section>

<section class="shop-team container">
	<h2 class="shop-team__title">Наша команда</h2>
	<?= make_img_html(
			get_field('shop_team'),
			array(
				'800' => 'mainStock_Phones',
				'1440' => 'shopTeam_720p',
				'1920' => 'shopTeam_1080p',
				'2560' => 'shopTeam_Retina',
				'4000' => 'shopTeam_4K'
			),
			array(
				'800' => '100vw',
				'1440' => '85vw',
				'1920' => '85vw',
				'2560' => '85vw',
				'4000' => '85vw'
			),
			'acf',
			'all-image shop-team__photo'
		) ?>
</section>

<?php get_footer(); ?>