<?php
	get_header();
	$args = array(
		'post_type' => 'review',
		'posts_per_page' => 4
	);
	$query = new WP_Query($args);
	$total_pages = $query->max_num_pages;
?>

<section class="all-review container">
	<h2 class="all-review__title">Отзывы</h2>

	<div class="all-review__items">
		<?php
			$number_of_gallery = 0;
			while( $query->have_posts() ) {
				$query->the_post();
				$number_of_gallery++;
				$name_of_gallery = 'review' . $number_of_gallery;
		?>
		
		<section class="one-review">
			<div class="one-review__gallery">
				<a class="one-review__button" href="<?= get_field('review_main_photo')['url'] ?>" data-fancybox="<?= $name_of_gallery ?>">
				 	<?= make_img_html(
				 		get_field('review_main_photo'),
				 		array(
				 			'800' => 'mainStock_Phones',
				 			'1440' => 'frontPost_720p',
				 			'1920' => 'frontPost_1080p',
				 			'2560' => 'frontPost_Retina',
				 			'4000' => 'frontPost_4K'
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
				 	) ?>
				</a>

				<div class="one-review-gallery">
					<?php 
						while( have_rows('review_gallery') ) : the_row();
							$image = make_img_html(
								get_sub_field('review_photo'),
						 		array(
						 			'800' => 'mainStock_Phones',
						 			'1440' => 'frontPost_720p',
						 			'1920' => 'frontPost_1080p',
						 			'2560' => 'frontPost_Retina',
						 			'4000' => 'frontPost_4K'
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
							echo '<a href="' . get_sub_field('review_photo')['url'] . '" data-fancybox="'.$name_of_gallery.'">' . $image . '</a>';
						endwhile; 
					?>
				</div>
			</div>

			<div class="one-review__information">
				<div class="one-review__date"><?= get_the_date() ?></div>
				<div class="one-review__author"><?= get_field('review_name') ?></div>
				<div class="one-review__text"><?= get_field('review_text') ?></div>
				<div class="one-review__line"></div>
			</div>

		</section>

		<?php } ?>
	</div>
	
	<?php if($total_pages > 1) { ?>
	<div class="all-review__button-wrapper">
		<button class="btn all-review__button">Все комментарии</button>
	</div>
	<?php } ?>
</section>

<section class="form-review-container">
	<h2 class="form-review__title">Оставить отзыв</h2>
	<div class="form-review" id="left-review"><?= do_shortcode('[contact-form-7 id="8272" title="Отзыв"]') ?></div>
</section>

<?php get_footer(); ?>