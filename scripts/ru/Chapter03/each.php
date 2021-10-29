<?php

$prices['Шины'] = 100;
$prices['Масло'] = 10;
$prices['Свечи зажигания'] = 4;

while ($element = each($prices)) {
  echo $element['key']." - ".$element['value'];
  echo "<br />";
}

?>