<?php
session_start();
 
  // Эти строки форматируют вывод в виде комментариев HTML
  // и неоднократно вызывают функцию dump_array().
 
  echo "\n<!-- НАЧАЛО ДАМПА ПЕРЕМЕННЫХ -->\n\n";
 
  echo "<!-- НАЧАЛО ПЕРЕМЕННЫХ GET -->\n";
  echo "<!-- ".dump_array($_GET)." -->\n";
 
  echo "<!-- НАЧАЛО ПЕРЕМЕННЫХ POST -->\n";
  echo "<!-- ".dump_array($_POST)." -->\n";
 
  echo "<!-- НАЧАЛО ПЕРЕМЕННЫХ СЕАНСА -->\n";
  echo "<!-- ".dump_array($_SESSION)." -->\n";
 
  echo "<!-- НАЧАЛО ПЕРЕМЕННЫХ COOKIE -->\n";
  echo "<!-- ".dump_array($_COOKIE)." -->\n";
 
  echo "\n<!-- КОНЕЦ ДАМПА ПЕРЕМЕННЫХ -->\n";
 
// Функция dump_array() принимает в качестве параметра массив.
// Она проходит по элементам массива, создавая одиночную строку
// для представления массива как набора.
 
function dump_array($array) {
 
  if(is_array($array)) {
 
    $size = count($array);
    $string = "";
    if($size) {
 
      $count = 0;
      $string .= "{ ";
      // Добавить в строку ключ и значение каждого элемента.
      foreach($array as $var => $value) {
 
        $string .= $var." = ".$value;
        if($count++ < ($size-1)) {
          $string .= ", ";
        }
      }
      $string .= " }";
    }
    return $string;
  } else {
    // Если в параметре передан не массив, то просто возвратить его.
    return $array;
  }
}
?>