<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
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
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

/*
if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs" role="tablist">

			<?php foreach ( $tabs as $key => $tab ) : 
				print_r($tab);
				?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; */ ?>

<div class="woocommerce-tabs wc-tabs-wrapper">
	<ul class="tabs wc-tabs" role="tablist">
		<li class="description_tab button_tab" id="tab-title-description" role="tab" aria-controls="tab-description">
			<a href="#tab-description">Описание</a>
		</li>
		<?php
			$i = 0;
			foreach(get_field('product_custom_tabs') as $tab) {
				$i++;
				$name = 'custom_'.$i; 
		?>
		<li class="<?= $name ?>_tab button_tab" id="tab-title-<?= $name ?>" role="tab" aria-controls="tab-<?= $name ?>">
			<a href="#tab-<?= $name ?>"><?= $tab['product_custom_tab_title'] ?></a>
		</li>
		<?php } ?>
	</ul>
	<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
		<div class="description_in_description_tab">
			<?php call_user_func( 'woocommerce_product_description_tab', 'description', $tabs[0] ); ?>
		</div>
		<div>
			<?php call_user_func( 'woocommerce_product_additional_information_tab', 'additional_information', $tabs[1] ); ?>
		</div>
	</div>
	<?php
		$i = 0;
		foreach(get_field('product_custom_tabs') as $tab) {
			$i++;
			$name = 'custom_'.$i; 
	?>
	<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?= $name ?> panel entry-content wc-tab" id="tab-<?= $name ?>" role="tabpanel" aria-labelledby="tab-title-<?= $name ?>">
		<?= $tab['product_custom_tab_content'] ?>
	</div>
	<?php } ?>
</div>


