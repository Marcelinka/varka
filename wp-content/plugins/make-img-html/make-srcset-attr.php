<?php

/* 
  функция для формирования аттрибута srcset
*/

function make_srcset_attr($images) {
    $srcset_tag = '';
    foreach($images as $key => $value) {
      $srcset_tag .= $value['url'] . " " . $key . "w, ";
    }
    return $srcset_tag;
  }

?>