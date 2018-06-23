<?php get_header(); ?>

<div class="all-stock-wrapper">
	<section class="all-stock__big-wrapper">
		<h2 class="all-stock__title">Акции и скидки</h2>
		<div class="all-stock__items">
			<?php
				$args = array(
					'post_type' => 'stock',
				    'nopaging' => true,
				    'stock_type' => 'discount'
				);
				$query = new WP_Query($args);
				//print_r($query);
				while($query->have_posts()) {
					$query->the_post();
			?>
		
			<a href="<?= get_permalink() ?>" class="all-stock__item all-stock__item_big">
				<div class="all-stock__item-title"><?= get_field('stock_preview_title') ?></div>
				<div class="all-stock__line"></div>
				<div class="all-stock__preview"><?= get_field('stock_preview_text') ?></div>
				<?= make_img_html(
					get_field('stock_preview_photo', $id),
					array( 
						'800' => 'frontStock_Phones',
						'1920' => 'shopMaster_1080p',
						'4000' => 'frontStock_4K'
					),
					array(
						'800' => '50vw',
						'1920' => '20vw',
						'4000' => '20vw'
					),
					'acf',
					'all-image'
				) ?>
			</a>

			<?php
				}
				wp_reset_query();
			?>
		</div>
	</section>

	<section class="all-stock__small-wrapper">
		<h2 class="all-stock__title">Сезонные акции</h2>
		<div class="all-stock__items">
			<?php
				$args = array(
					'post_type' => 'stock',
				    'nopaging' => true,
				    'stock_type' => 'month'
				);
				$query = new WP_Query($args);
				while($query->have_posts()) {
					$query->the_post();
			?>
			
			<a href="<?= get_permalink() ?>" class="all-stock__item all-stock__item_small">
				<div class="all-stock__item-title"><?= get_field('stock_preview_title') ?></div>
				<div class="all-stock__line"></div>
				<div class="all-stock__preview"><?= get_field('stock_preview_text') ?></div>
				<?= make_img_html(
					get_field('stock_preview_photo', $id),
					array( 
						'800' => 'frontStock_Phones',
						'1920' => 'shopMaster_1080p',
						'4000' => 'frontStock_4K'
					),
					array(
						'800' => '50vw',
						'1920' => '20vw',
						'4000' => '20vw'
					),
					'acf',
					'all-image'
				) ?>
			</a>

			<?php
				}
			?>
		</div>
	</section>
</div>

<?php get_footer(); ?>