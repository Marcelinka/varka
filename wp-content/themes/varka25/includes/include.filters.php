<?php

function woo_filters($attributes) {
  do_shortcode('[br_filters attribute=price type=slider title="Цена"]');

	$attributes = explode(',',$attributes);

	foreach($attributes as $atr) {
		$title = stristr($atr, ':', true);
		$name = 'pa_' . substr( stristr($atr, ':'),1 );
		$string_shortcode = '[br_filters attribute='.$name.' type=checkbox title="'.$title.'"]';
		do_shortcode($string_shortcode);
	}

  /*// Фильтры для смесителей
  function faucets_filters() {
    do_shortcode('[br_filters attribute=pa_faucet-type type=checkbox title="Тип смесителя"]');
    do_shortcode('[br_filters attribute=pa_faucet-installation-type type=checkbox title="Монтаж"]');
    //do_shortcode('[br_filters attribute=pa_faucet-color type=select title="Цвет смесителя"]');
  };
  echo '<div class="filters filters-' . $category_slug . ' filters-' . $parent_category_slug . '">';
    if ($parent_category_slug == 'sinks') { // Фильтры в категории "Мойки"
      switch ($category_slug) {
        case 'sinks-ceramics':
          sinks_ceramic();
          break;
        default:
          sinks_filters();
          break;
      }
    } else if ($parent_category_slug == 'faucets') { // Фильтры в категории "Смесители"
      switch ($category_slug) {
        default:
          faucets_filters();
          break;
      }
    }
  echo '</div>';*/
}