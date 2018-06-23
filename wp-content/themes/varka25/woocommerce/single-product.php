<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );

		echo '
			<div class="single-product container">
				<div class="catalog__header">
					<h2 class="catalog__title">Каталог товаров</h2>
					<section class="catalog__categories">
		';

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

			array_push( $terms_dropdown['other'], $term_data );

			echo '<a class="catalog__category" href="'. $term_link .'">'. $term->name .'</a>';
		}

		echo '
			</section>

			<section class="post-tags__dropdown container hidden hidden_phones">
				<div class="post-tags__active dropdown-button">
					<span> Категория </span>
						<div class="post-tags__arrow">'.
							file_get_contents( get_template_directory_uri().'/img/svg/arrow-down.svg' )
						.'</div>
				</div>
				<div class="post-tags__links dropdown-menu dropdown-menu_hidden">
		';

		foreach( $terms_dropdown['other'] as $term ) {
			echo '<a class="post-tags__link" href="'. $term['link'] .'">'. $term['name'] .'</a>';
		}

		echo '
				</div>
			</section>
		</div>
		';
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		echo '</div>';
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
