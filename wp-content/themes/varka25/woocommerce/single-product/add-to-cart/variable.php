<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<div class="variations-container">

<?php foreach ( $attributes as $attribute_name => $options ) : ?>

<p class="variations-container__title">Выберите подходящий вариант продукта</p>

<?php //echo '<p class="variations-container__attr-description">' . wc_attribute_label( $attribute_name ) . ' ' . get_the_title() . '</p>'; ?>

			<?php
				$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );

				echo '<div class="variation-labels-wrapper">';

				foreach ( $available_variations as $variation ) {

					// Get variation attribute name inspite of slug
					$taxonomy = $attribute_name;
					$meta = get_post_meta( $variation['variation_id'], 'attribute_'.$taxonomy, true );
					$term = get_term_by('slug', $meta, $taxonomy);
					// Set variables
					$variation_img = $variation['image']['src'];
					$variation_img_srcset = $variation['image']['srcset'];
					$variation_name = $term->name;
					$variation_attribute_slug = $variation['attributes']['attribute_' . $attribute_name];
					$variation_sku = $variation['sku'];
					$variation_id = $variation['variation_id'];
					$variation_price = $variation['display_price'];
					$variation_price_formatted = number_format($variation_price, 0, '.', ' ') . ' ₽';
					echo '<input class="variation-input" type="radio" id="' . $variation_attribute_slug . '" name="variation" value="' . $variation_attribute_slug . '">';
					echo '<label data-price="' . $variation_price_formatted .
					'" data-img-srcset="' . $variation_img_srcset .
					'" data-img="'. $variation_img .
					'" data-id="' . $variation_id .
					'" for="' . $variation_attribute_slug .
					'" class="variation-input-label"><div class="variation-img-container"><img class="variation-img" src="' . $variation_img .'" alt="">
					</div><p>' . $variation_name . '<br>
					<span class="variation-sku">(' . $variation_sku . ')</span>'.
					/*<span class="variation-price"> Цена: ' . $variation_price_formatted . '</span>*/'</p></label>';
				}

				echo '</div>';

				/*echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) : '';*/
			?>
<?php endforeach;?>

</div>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">
							<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );
								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
								echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) : '';
							?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap">
			<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
