<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

$path = explode('/',$_SERVER["REQUEST_URI"]);
array_shift($path);
array_pop($path);

?>

<div class="catalog__header">
	<h2 class="catalog__title">Каталог товаров</h2>
	<section class="catalog__categories container">
	<?php
		$args = array(
		    'taxonomy' => 'product_cat',
		    'hide_empty' => false,
		    'exclude' => '15',
		    'parent' => 0
		);
		$terms = get_terms( $args );

		$terms_dropdown = array(
			'other' => array()
		);

		foreach ( $terms as $term ) {
			$id = $term->term_id;
			$term_link = get_term_link( $id, 'product_cat' );

			$term_data = array(
				'link' => $term_link,
				'name' => $term->name
			);

			if( $term->slug == $path[1] ) {
				$args = array(
					'taxonomy' => 'product_cat',
					'hide_empty' => false,
					'parent' => $id
				);
				$subterms = get_terms($args);
				foreach( $subterms as $subterm ) {
					//print_r($subterm);
					if( strpos($subterm->slug, 'sub_') === 0 ) $subcategories_id = $subterm->term_id;
					if( strpos($subterm->slug, 'brand_') === 0 ) $subbrands_id = $subterm->term_id;
				}

				$terms_dropdown['active'] = $term_data;
			} else {
				array_push( $terms_dropdown['other'], $term_data );
			}
	?>
	
		<a class="catalog__category <?php if( $term->slug == $path[1] ) echo 'catalog__category_active' ?>" href="<?= $term_link ?>">
			<?= $term->name ?>
		</a>

	<?php
		}
	?>
	</section>

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

<div class="container sidebar-content-wrapper">
	<aside class="sidebar sidebar_tablets sidebar_tablets_hidden">
		<?php if( count($path) == 2 || $path[2] == 'page' || $path[1] == 'washing' ) { ?>
			<div class="sidebar__item <?php if($path[1] == 'washing' && count($path) == 2) echo('sidebar__item_washing') ?>">
				<h2 class="sidebar__title">Наименование</h2>
				<div class="sidebar__part sidebar__titles">
				<?php
					if($subcategories_id) {
						$args = array(
							'taxonomy' => 'product_cat',
							'hide_empty' => true,
							'parent' => $subcategories_id
						);	
						 
						$subcategories = get_terms($args);
						foreach($subcategories as $sub) {
				?>
					
						<a class="sidebar__link" href="<?= get_term_link( $sub->term_id, 'product_cat' ) ?>"><?= $sub->name ?></a>

				<?php
						}
					}
				?>
				</div>
			</div>
			
			<?php if( $path[1] != 'washing' ) { ?>
			<div class="sidebar__item">
				<h2 class="sidebar__title">Бренд</h2>
				<div class="sidebar__part sidebar__brands">
				<?php
					if($subbrands_id) {
						$args = array(
							'taxonomy' => 'product_cat',
							'hide_empty' => true,
							'parent' => $subbrands_id
						); 
						$subbrands = get_terms($args);
						foreach($subbrands as $brand) { ?>
					
						<a class="sidebar__link" href="<?= get_term_link( $brand->term_id, 'product_cat' ) ?>"><?= $brand->name ?></a>

				<?php
						}
					}
				?>
				</div>
			</div>
			<?php } ?>
		<?php 
			} 
			if( count($path) > 2 && ($path[2] != 'page' || $path[1] == 'washing') ) {
				$subcategory_slug = $path[3];
				$subcategory = get_terms('slug='.$subcategory_slug)[0];
				$filters = get_field('atribute_filters',$subcategory);
		?>
		
		<h2 class="sidebar__title sidebar__title_filters"><?= $subcategory->name ?></h2>

		<?php 
				if($filters) {
					woo_filters($filters);
				}
			} 
		?>
	</aside>
	
	<div class="cat-products">
		<?php

		if ( have_posts() ) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked wc_print_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );

			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}

		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );

		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
		?>
	</div>
</div>

<?php get_footer( 'shop' ); ?>
