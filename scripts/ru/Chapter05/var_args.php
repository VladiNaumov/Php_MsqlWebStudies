<?php

function var_args() {
  echo 'Количество параметров:';
  echo func_num_args();

  echo '<br />';
  $args = func_get_args();
  foreach ($args as $arg) {
    echo $arg.'<br />';
  }
}

var_args(1,2,3);

var_args('приветствуем', 47.3);

?>
