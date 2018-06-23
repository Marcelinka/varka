<div class="blog-header">
	<h2 class="catalog__title">Блог</h2>
	<div class="post-sticky-wrapper container">
		<section class="post-sticky">
			<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => '1',
					'tag_id' => '73'
				);
				$query = new WP_Query($args);
				while( $query->have_posts() ) {
					$query->the_post();
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
							'all-image'
						);
					}
			?>
			
			<div class="post-sticky__media"><?= $media ?></div>
			<div class="post-sticky__content">
				<div class="post-sticky__text">
					<h2 class="post-sticky__title"><?= get_the_title() ?></h2>
					<div class="post-sticky__preview"><?= get_field('post_preview') ?></div>
					<a href="<?= get_permalink() ?>" class="btn btn_white">Подробнее</a>
				</div>
			</div>

			<?php
				}
				wp_reset_query();
			?>
		</section>
	</div>
	
	<div class="post-tags-wrapper">
		<section class="catalog__categories post-tags container">
			<?php
				$args = array(
				    'taxonomy' => 'category',
				    'hide_empty' => false,
				    'exclude' => '1'
				);
				$terms = get_terms( $args );

				$path = $_SERVER["REQUEST_URI"];
				$terms_dropdown = array(
					'other' => array()
				);

				foreach ( $terms as $term ) {
					$id = $term->term_id;
					$term_link = get_term_link( $id, 'category' );
					$link_crop = substr( $term_link, -strlen($path) );

					$term_data = array(
						'link' => $term_link,
						'name' => $term->name
					);

					if( $link_crop == $path ) {
						$terms_dropdown['active'] = $term_data;
					} else {
						array_push( $terms_dropdown['other'], $term_data );
					}
			?>
			
				<a class="catalog__category <?php if( $link_crop == $path ) echo 'catalog__category_active' ?>" href="<?= $term_link ?>">
					<?= $term->name ?>
				</a>

			<?php
				}
			?>
		</section>
	</div>

	<section class="post-tags__dropdown container hidden hidden_phones">
		<div class="post-tags__active dropdown-button">
			<span>
				<?php 
					if($terms_dropdown['active']) 
						echo $terms_dropdown['active']['name'];
					else
						echo 'Категория'
				?>
			</span>
			<div class="post-tags__arrow">
				<?= file_get_contents( get_template_directory_uri().'/img/svg/arrow-down.svg' ) ?>
			</div>
		</div>
		<div class="post-tags__links dropdown-menu dropdown-menu_hidden">
			<?php
				foreach( $terms_dropdown['other'] as $term ) { ?>
			
			<a class="post-tags__link" href="<?= $term['link'] ?>"><?= $term['name'] ?></a>

			<?php
				}
			?>
		</div>
	</section>
</div>
