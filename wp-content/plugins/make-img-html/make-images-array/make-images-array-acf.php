<?php

/* 
  функция для формирования ассоциативного массива изображений $images, в котором
    $key - брейкпоинт соответсвующий изображению
    $value - ассоциативный массив из url и width для каждого изображения
*/

function make_images_array_acf($images_tpl, $data) {
    $images = array();
  
    $sizes = $data['sizes'];
    foreach($images_tpl as $key => $value) {
      $images[$key] = array (
        'url' => $sizes[$value],
        'width' => $sizes[$value."-width"]
      );
    }
  
    return $images;
  }

?>