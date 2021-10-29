<?php
function fn() {
  global $var;
  $var = 'содержимое';
  echo 'внутри функции $var = '.$var.'<br />';
}

fn();
echo 'вне функции $var = '.$var;
?>