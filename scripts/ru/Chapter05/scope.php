<?php
function fn() {
  echo 'внутри функции сначала $var = '.$var.'<br />';
  $var = 2;
  echo 'затем внутри функции $var = '.$var.'<br />';
}
$var = 1;
fn();
echo 'вне функции $var = '.$var.'<br />';
?>