<?php

/* 
  функция для формирования аттрибута sizes
*/

function make_sizes_attr($sizes){
    $sizes_attr = '';
    $i = 0;
    foreach($sizes as $key => $value) {
      $i++;
      if ($i == count($sizes)) {
        $sizes_attr .= $key . "px";
      } else {
        $sizes_attr .= "(max-width: " . $key . "px) " . $value . ", ";
      }
    }
    return $sizes_attr;
  }

?>