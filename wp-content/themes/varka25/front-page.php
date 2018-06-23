<?php get_header(); ?>

<!-- Главная акция -->
<section class="main-stock">
	<?= make_img_html( 
			get_field('main_stock_picture'),
			array(
				'800'  => 'mainStock_Phones',
				'1440' => 'mainStock_720p',
				'1920' => 'mainStock_1080p',
				'2560' => 'mainStock_Retina',
				'4000' => 'mainStock_4K'
			),
			array(
				'800'  => '100vw',
            	'1440' => '100vw',
            	'1920' => '100vw',
            	'2560' => '100vw',
            	'4000' => '100vw'
			),
			'acf',
			'main-stock__background'
		) 
	?>
	<div class="main-stock__content">
		<div class="footer__links main-stock__links">
			<a href="<?= get_field('global_instagram', 'options') ?>" class="footer__link">Instagram</a>
			|
			<a href="<?= get_field('global_facebook', 'options') ?>" class="footer__link">Facebook</a>
			|
			<a href="<?= get_field('global_youtube', 'options') ?>" class="footer__link">Youtube</a>
		</div>
		<div class="main-stock__subtitle"><?= get_field('main_stock_type') ?></div>
		<div class="main-stock__text">
			<h1 class="main-stock__title"><?= get_field('main_stock_title') ?></h1>
			<div class="main-stock__preview"><?= get_field('main_stock_preview') ?></div>
		</div>
		<a href="<?= get_field('main_stock_href') ?>" class="btn btn_white main-stock__button">Подробнее</a>
	</div>
</section>

<!-- Категории -->
<section class="categories-block container">
	<h2 class="categories-block__title">Категории товаров</h2>
	<div class="categories">
		<?php
			$args = array(
			    'taxonomy' => 'product_cat',
			    'hide_empty' => false,
			    'exclude' => '15',
			    'parent' => 0
			);
			$terms = get_terms( $args );

			foreach ( $terms as $term ) {
				$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
		?>
		
		<a class="category-wrapper" href="<?= get_term_link( $term->term_id, 'product_cat' ) ?>">
			<div class="category-link">
				<?= make_img_html(
			    		$thumbnail_id,
			    		array(
			    			'800'  => 'mainStock_Phones',
							'1920' => 'frontCategory_1080p',
							'4000' => 'frontCategory_4K'
			    		),
			    		array(
			    			'800'  => '100vw',
							'1920' => '15vw',
							'4000' => '15vw'
			    		),
			    		'wp',
			    		'category__image'
			    	)
				?>
				<div class="category__name"><span class="category__name-border"><?= $term->name ?></span></div>
			</div>
		</a>

		<?php
			}
		?>
	</div>
</section>

<!-- Акции и скидки -->
<section class="stocks container">
	<div class="btn-right-corner">
		<h2 class="stocks__title">Акции и скидки</h2>
		<a class="btn-dots stocks__button" href="/stock">
			Все акции
			<div class="btn-dots__dots">
				<?= file_get_contents( get_template_directory_uri().'/img/svg/btn-dots.svg' ) ?>
			</div>
		</a>
	</div>
	<!--<div class="stocks__big">
		<?php
			while ( have_rows('special_stock_big') ) : the_row();
			    $stock = get_sub_field('special_stock_big_item');
			    $id = $stock->ID;		
		?>

		<a class="stock stock_big" href="<?= get_permalink( $id ) ?>">
			<div class="stock__text">
				<div class="stock__title"><?= get_field('stock_preview_title', $id) ?></div>
				<div class="stock__line"></div>
				<div class="stock_big__preview"><?= get_field('stock_preview_text', $id) ?></div>
			</div>
			<? /*make_img_html(
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
					'stock__image'
				)*/ ?>
		</a>

		<?php 	
			endwhile;
		?>
	</div>-->
	<div class="stocks__small">
		<?php
			while( have_rows('special_stock_small') ) : the_row();
				$stock = get_sub_field('special_stock_small_item');
				$id = $stock->ID;
		?>

		<a href="<?= get_permalink( $id ) ?>" class="stock stock_small">
			<div class="stock__text stock_small__text">
				<div class="stock_small__season">Сезонные скидки</div>
				<div class="stock__title"><?= get_field('stock_preview_title', $id) ?></div>
				<div class="stock__line stock__line_small"></div>
				<div class="stock_small__preview"><?= get_field('stock_preview_text', $id) ?></div>
			</div>
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
					'stock__image'
				) ?>
		</a>

		<?php
			endwhile;
		?>
	</div>
	<a class="btn-dots btn-dots_black btn-dots_hidden btn-dots_phones" href="/stock">
		Все акции
		<div class="btn-dots__dots">
			<?= file_get_contents( get_template_directory_uri().'/img/svg/btn-dots.svg' ) ?>
		</div>
	</a>
</section>

<!-- Инстаграм и Наша команда -->
<div class="insta-team">
	<div class="insta-team-wrapper container">
		<section class="instagram">
			<div class="btn-right-corner instagram__title-block">
				<h2>Instagram</h2>
				<a class="btn-dots btn-dots_white" href="<?= get_field('global_instagram', 'options') ?>">
					Наш Instagram
					<div class="btn-dots__dots">
						<?= file_get_contents( get_template_directory_uri().'/img/svg/btn-dots.svg' ) ?>
					</div>
				</a>
			</div>
			<div class="hidden hidden_phones instagram__logo">
				<?= file_get_contents( get_template_directory_uri().'/img/svg/instagram.svg' ) ?>
			</div>
			<div class="instagram__photos">
				<div class="instagram__photo"></div>
				<div class="instagram__photo"></div>
				<div class="instagram__photo"></div>
				<div class="instagram__photo"></div>
				<div class="instagram__photo"></div>
				<div class="instagram__photo"></div>
				<div class="instagram__photo"></div>
				<div class="instagram__photo"></div>
				<div class="instagram__photo"></div>
			</div>
			<div class="hidden hidden_phones instagram__button-wrapper">
				<a href="<?= get_field('global_instagram', 'options') ?>" class="btn btn_white instagram__button">Instagram</a>
			</div>
		</section>
		<section class="team">
			<h2 class="team__title">Наша команда</h2>
			<div class="team__image-wrapper">
				<?= make_img_html( 
						get_field('team_photo'),
						array(
							'1440' => 'frontPost_720p',
							'1920' => 'frontPost_1080p',
							'2560' => 'shopGallery_Retina',
							'4000' => 'frontTeam_4K'
						),
						array(
			            	'1440' => '37vw',
			            	'1920' => '37vw',
			            	'2560' => '37vw',
			            	'4000' => '37vw'
						),
						'acf',
						'team__photo'
					)
				?>
			</div>
		</section>
	</div>
</div>

<!-- Последнее статьи -->
<div class="container posts-wrapper">
	<div class="video-advices-wrapper">
		<section class="post video">
			<?php
				$args = array(
				    'post_type' => 'post',
				    'posts_per_page' => '1',
				    'category_name' => 'video'
				);
				$query = new WP_Query( $args );
				while( $query->have_posts() ) {
					$query->the_post(); ?>
			
			<div class="article__title">
				<span class="article__name">Видео</span>
				<a class="btn-dots" href="<?= get_term_link( 70, 'category' ) ?>">
					Все видео
					<div class="btn-dots__dots">
						<?= file_get_contents( get_template_directory_uri().'/img/svg/btn-dots.svg' ) ?>
					</div>
				</a>
			</div>
			<?= get_field('post_video') ?>
			<div class="video__description">
				<p class="video__title"><?= get_the_title() ?></p>
				<p class="video__text"><?= get_field('post_preview') ?></p>
			</div>

			<?php	
				}
				wp_reset_query();
			?>
		</section>

		<section class="post advices">
			<?php

				if( have_rows('post_advice', 15) ):
				    while ( have_rows('post_advice', 15) ) : the_row(); ?>
			
			<a class="advice" href="<?= get_sub_field('advice_href') ?>"><h3 class="advice__title"><?= get_sub_field('advice_title') ?></h3></a>

			<?php
					endwhile;
				endif; ?>
		</section>
	</div>

	<div class="article-recipe-wrapper">
		<section class="post article">
			<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => '1',
					'category_name' => 'article'
				);
				$query = new WP_Query($args);
				while( $query->have_posts() ) {
					$query->the_post();
					$thumbnail_id = get_post_thumbnail_id();
			?>

			<div class="article__title">
				<span class="article__name">Блог</span>
				<a class="btn-dots" href="<?= get_permalink(22) ?>">
					Все посты
					<div class="btn-dots__dots">
						<?= file_get_contents( get_template_directory_uri().'/img/svg/btn-dots.svg' ) ?>
					</div>
				</a>
			</div>
			<?= make_img_html(
					$thumbnail_id,
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
					'wp',
					'article__image'
				)
			?>
			<h2 class="article__text"><?= get_the_title() ?></h2>
			<p class="article__preview"><?= get_field('post_preview') ?></p>
			<div class="article__button-wrapper"><a href="<?= get_permalink() ?>" class="btn article__button">Подробнее</a></div>

			<?php
				}
				wp_reset_query();
			?>
		</section>

		<section class="post recipe">
			<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => '1',
					'category_name' => 'recipe'
				);
				$query = new WP_Query($args);
				while( $query->have_posts() ) {
					$query->the_post();
					$thumbnail_id = get_post_thumbnail_id();
			?>
			
			<div class="article__title">
				<span class="article__name">Рецепт дня</span>
				<a class="btn-dots" href="<?= get_term_link( 71, 'category' ) ?>">
					Все рецепты
					<div class="btn-dots__dots">
						<?= file_get_contents( get_template_directory_uri().'/img/svg/btn-dots.svg' ) ?>
					</div>
				</a>
			</div>
			<?= make_img_html(
					$thumbnail_id,
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
					'wp',
					'article__image'
				)
			?>
			<h2 class="article__text"><?= get_the_title() ?></h2>
			<p class="article__preview"><?= get_field('post_preview') ?></p>
			<div class="article__button-wrapper"><a href="<?= get_permalink() ?>" class="btn article__button">Подробнее</a></div>

			<?php
				}
				wp_reset_query();
			?>
		</section>
	</div>
</div>

<?php get_footer(); ?>
