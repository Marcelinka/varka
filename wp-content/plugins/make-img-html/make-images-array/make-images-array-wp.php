<?php

/*
  функция для получения массива с данными об изображении Wordpress
  формирование массива по типу acf
*/

function make_images_array_wp($images_tpl, $info) {
    $images = array();
  
    foreach($images_tpl as $key => $value) {
      $src = wp_get_attachment_image_src( $info, $value );
      $images[$key] = array (
        'url' => $src[0],
        'width' => $src[1]
      );
    }
    //echo 'Полученный массив данных:<br>';
    //print_r($images);
  
    return $images;
  }

  ?>