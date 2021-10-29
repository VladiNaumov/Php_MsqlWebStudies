<?php

function fizzbuzz($start, $end)
{
  $current = $start;
  while ($current <= $end) {
    if ($current%3 == 0 && $current%5 == 0) {
      yield "бим-бом";
    } else if ($current%3 == 0) {
      yield "бим";
    } else if ($current%5 == 0) {
      yield "бом";
    } else {
      yield $current;
    }
    $current++;
  }
}

foreach(fizzbuzz(1,20) as $number) {
  echo $number.'<br />';
}
?>
