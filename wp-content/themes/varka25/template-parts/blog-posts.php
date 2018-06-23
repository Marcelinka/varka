<?php
	global $wp_query;
	global $query_string;

	$wp_query = new WP_Query( $query_string . '&tag__not_in=73' );
	$total_pages = $wp_query->max_num_pages;
?>

<div class="blog-wrapper container">
	<section class="blog-items">
		<?php
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
						'blog__image'
					);
				}
		?>
		
		<div class="blog__item">
			<a href="<?= get_permalink() ?>">
				<div class="blog__media"><?= $media ?></div>
				<div class="blog__title"><?= get_the_title() ?></div>
				<div class="blog__preview"><?= get_field('post_preview') ?></div>
			</a>
			<a class="btn btn_white blog__item-buttom hidden hidden_phones" href="<?= get_permalink() ?>">Подробнее</a>
		</div>

		<?php
			}
		?>
	</section>
	
	<?php if($total_pages > 1) { ?>
	<div class="blog__button-wrapper">
		<button class="blog__button btn" data-total-pages="<?= $total_pages ?>" data-current-page='1' data-query='<?= $query_string ?>'>
			Показать ещё
		</button>
	</div>
	<?php } ?>
</div>

<?php

wp_reset_query();