<?php

/*
	Удаляем ненужные элементы
*/
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );  // Кнопка добавить в корзину в каталоге
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 ); // Сайдбар woocommerce
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 ); // Рейтинг товара
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 ); // Краткое описание товара
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 ); // Поделиться
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 ); // Продано все
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 ); // Похожие продукты
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); // Количество найденных товаров в каталоге
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); // Сортировка в каталоге
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 ); // Изменяем порядок c 40 на 7
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 7);

// Добавить вывод блока перед названием в каталоге
add_action( 'woocommerce_before_shop_loop_item_title', 'action_woocommerce_before_shop_loop_item_title', 10, 0 ); 
function action_woocommerce_before_shop_loop_item_title() {
	global $product;
	
	echo '
		<div class="main-catalog__more">
			<span class="main-catalog__more-text">Подробнее</span>
		</div>
	';
}

// Добавить обертку до хлебных крошек
add_action( 'woocommerce_before_main_content', 'woocommerce_before_breadcrumb', 15, 0 );
function woocommerce_before_breadcrumb() {
	global $product;
	
	echo '
		<div class="catalog__breadcrumb container">
	';
}

// Закрыть обертку после хлебных крошек
add_action( 'woocommerce_before_main_content', 'woocommerce_after_breadcrumb', 25, 0 );
function woocommerce_after_breadcrumb() {
	global $product;
	
	echo '
		</div>
	';
}

// Кнопка Добавить в wishlist
add_action( 'woocommerce_single_product_summary', 'woocommerce_after_single_product_summary', 65, 0 );
function woocommerce_after_single_product_summary() {
	global $product;
	/*echo '<pre>';
	print_r($product);
	echo '</pre>';*/
	$product_id = $product->get_id();
	$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'woocommerce_thumbnail' )[0];
	$url = get_permalink( $product_id );
	$sku = $product->sku;
	$price = $product->price;

	echo '
		<div class="add-in-storage-container">
			<button-wishlist product-id="'.$product_id.'" product-image="'.$image_src.'" product-name="'.$product->name.'"
			product-link="'.$url.'" product-sku="'.$sku.'" product-price="'.$price.'" :product-array="products" @remove-product="remove" @add-product="add"></button-wishlist>
		</div>
	';

	$attributes = array(
		'height' => '',
		'width' => '',
		'deep' => '',
		'other' => ''
	);
	foreach($product->category_ids as $category_id) {
		/*$category = get_term($category_id);
		//print_r($category);
		$slug_height = get_field('product_height', $category);
		echo $slug_height;*/

		$category = get_term($category_id);
		//print_r($category->parent);
		$category_parent = get_term($category->parent);
		//print_r($category_parent);
		if(substr($category_parent->slug, 0, 4) == 'sub_') {
			//print_r($category);
			$attributes['height'] = get_field('product_height', $category);
			$attributes['width'] = get_field('product_width', $category);
			$attributes['deep'] = get_field('product_deep', $category);
			$attributes['other'] = get_field('product_main_attributes', $category);
		}
	}
	
	foreach($attributes as $key => $value) {
		if($value) {
			switch($key) {
				case 'height':
				case 'width':
				case 'deep':
					$attributes[$key] = get_the_terms( $product_id, 'pa_'.$value )[0]->name;
					break;
				case 'other':
					$other = explode(',',$value);
					$attributes[$key] = array();
					/*foreach($other as $atr) {
						$attributes[$key].push(array(
							'title' => stristr($atr, ':', true),
							'value' => implode(', ', get_the_terms( $product_id, substr( stristr($atr, ':'),1 ) ))
						));
					}*/
			}
		}
	}

	/*foreach($attributes['other'] as $atr) {
		echo $atr['title'] . ' ' . $atr['value'];
	}*/

	$opinion = get_field('product_opinion', $product_id);
	if($opinion) {
		echo '
			<div class="product-opinion">
				<div class="product-opinion__title">Мнение Varka:</div>
				<div class="product-opinion__text">'.$opinion.'</div>
			</div>
		';
	}
}