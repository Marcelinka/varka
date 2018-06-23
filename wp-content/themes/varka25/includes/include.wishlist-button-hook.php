<?php

function change_menu_item_args( $args, $item ) {
	if($item->title == 'Wishlist') {
		$args->link_after = '<span class="wishlist-count" v-show="count"><div v-text="count"></div></span>';
	}

	return $args;
}

add_filter( 'nav_menu_item_args', 'change_menu_item_args', 10, 2 );