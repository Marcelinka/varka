<?php
/*
Plugin Name: Make Images Html
Description: Плагин для автоматического генерирования HTML-разметки адаптивного изорбажения из массива изображенией ACF и WP.
Делает доступной функцию make_img_html($data, $images_tpl, $class, $standart)
Version: 1.1
Author: aisa_agency

Функция для генерирования html для изображения с srcset и sizes
Аргументы:
  $info - информация для получения массива с данными об изображение
    если $mode='acf', то нужно передать массив оригинального изображения
    если $mode='wp', то нужно передать id элемента
  $images_tpl - шаблон для генерирования, массив вида <width_screen> => <name_of_size> от меньшего к большему
  [$mode] - вид картинки: тип из плагина acf ['acf'] или attachment от wordpress ['wp'], по умолчанию 'acf'
  [$class] - класс для изображения, по умолчанию пустая строка
  [$standart] - ширина экрана для стандартного изображения (запись в src), по умолчанию '1920'
  [$sizes] - маccив относительных размеров для картинок на разных разрешениях экрана
  (в том же порядке, что и исходных массив изображений)
*/

/* 
  функции для формирования ассоциативного массива изображений $images
*/
require_once(plugin_dir_path( __FILE__ ) . 'make-images-array/make-images-array-wp.php');
require_once(plugin_dir_path( __FILE__ ) . 'make-images-array/make-images-array-acf.php');

/* 
  функция для формирования аттрибута srcset
*/
require_once(plugin_dir_path( __FILE__ ) . 'make-srcset-attr.php');

/* 
  функция для формирования аттрибута sizes
*/
require_once(plugin_dir_path( __FILE__ ) . 'make-sizes-attr.php');


function make_img_html($info, $images_tpl, $sizes, $mode='acf', $class='', $standart='1920', $alt='') {
  // формируем массив изображений для wp
  if( $mode == 'wp' ) {
    //echo 'Начало обработки wp-изображения с id='.$info.'<br>';
    $images = make_images_array_wp($images_tpl, $info);
  // формируем массив изображений для acf
  } elseif ($mode == 'acf') {
    $images = make_images_array_acf($images_tpl, $info);
  }
  // формируем аттрибут srcset
  $srcset_attr = make_srcset_attr($images);
  // формируем аттрибут sizes
  $sizes_attr = make_sizes_attr($sizes);
  // формируем код тэга img до атрибута srcset
  $img_html = "<img
    alt='" . $alt . "'
    class='" . $class . "' 
    src='" . $images[$standart]['url'] . "' 
    srcset='" . $srcset_attr . "' 
    sizes='" . $sizes_attr . "'>";

  return $img_html;
}

/**
 * Функция генерирует html-разметку для асинхронного адаптивного изображения
 * на основе ассоциативного массива информации об изображении из WP или ACF.
 *
 * @since 1.2
 *
 * @param Array  $info                 Информация для получения массива с данными об изображении.
 * @param Array  $images_tpl           Description.
 * @param Array  $sizes                Description.
 * @param String $mode (optional)      Description.
 * @param String $class (optional)     Description.
 * @param String $standart (optional)  Description.
 * @param String $preview (optional)   Description.
 * @param String $alt (optional)       Description.

 * @return String Description.
 */

function make_lazy_img_html($info, $images_tpl, $sizes, $mode='acf', $class='', $standart='1920', $preview='20', $alt='') {
  // формируем массив изображений для wp
  if( $mode == 'wp' ) {
    //echo 'Начало обработки wp-изображения с id='.$info.'<br>';
    $images = make_images_array_wp($images_tpl);
  // формируем массив изображений для acf
  } elseif ($mode == 'acf') {
    $images = make_images_array_acf($images_tpl, $info);
  }
  // формируем аттрибут srcset
  $srcset_attr = make_srcset_attr($images);
  // формируем аттрибут sizes
  $sizes_attr = make_sizes_attr($sizes);

  $img_html = "<a href='". $images[$standart]['url'] ."' 
    data-srcset='" . $srcset_attr ."'
    data-sizes='" . $sizes_attr . "'
    class='progressive replace'>
    <img src='". $images[$preview]['url'] ."' class='". $class ."'  alt='" . $alt . "' />
  </a>";

  return $img_html;
}

?>