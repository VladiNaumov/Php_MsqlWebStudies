<?php
  // создать короткие имена переменных
  $tireqty = (int) $_POST['tireqty'];
  $oilqty = (int) $_POST['oilqty'];
  $sparkqty = (int) $_POST['sparkqty'];
  $address = preg_replace('/\t|\R/',' ',$_POST['address']);
  $document_root = $_SERVER['DOCUMENT_ROOT'];
  $date = date('H:i, jS F Y');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Автозапчасти от Вовки - Результаты заказа</title>
  </head>
  <body>
    <h1>Автозапчасти от Вовки</h1>
    <h2>Результаты заказа</h2> 
    <?php
      echo "<p>Заказ обработан в ".date('H:i, jS F Y')."</p>";
      echo "<p>Ваш заказ: </p>";

      $totalqty = 0;
      $totalamount = 0.00;

      define('TIREPRICE', 100);
      define('OILPRICE', 10);
      define('SPARKPRICE', 4);

      $totalqty = $tireqty + $oilqty + $sparkqty;
      echo "<p>Заказано товаров: ".$totalqty."<br />";

      if ($totalqty == 0) {
        echo "Вы ничего не заказали на предыдущей странице!<br />";
      } else {
        if ($tireqty > 0) {
          echo htmlspecialchars($tireqty).' шин<br />';
        }
        if ($oilqty > 0) {
          echo htmlspecialchars($oilqty).' бутылок масла<br />';
        }
        if ($sparkqty > 0) {
          echo htmlspecialchars($sparkqty).' свечей зажигания<br />';
        }
      }

      $totalamount = $tireqty * TIREPRICE
                   + $oilqty * OILPRICE
                   + $sparkqty * SPARKPRICE;

      echo "Итого: $".number_format($totalamount,2)."<br />";

      $taxrate = 0.10;  // местный налог с продаж составляет 10%
      $totalamount = $totalamount * (1 + $taxrate);
      echo "Всего, включая налог с продаж: $".number_format($totalamount,2)."</p>";

      echo "<p>Адрес для доставки: ".htmlspecialchars($address)."</p>";

      $outputstring = $date."\t".$tireqty." шин\t".$oilqty." бутылок масла\t"
                      .$sparkqty." свечей зажигания\t\$".$totalamount
                      ."\t". $address."\n";

       // открыть файл для дописывания
	   @$fp = fopen("$document_root/../orders/orders.txt", 'ab');
	   
	   if (!$fp) {
         echo "<p><strong>В настоящий момент ваш запрос не может быть обработан.
               Пожалуйста, попробуйте позже.</strong></p>";
         exit;
       }

       flock($fp, LOCK_EX);
       fwrite($fp, $outputstring, strlen($outputstring));
       flock($fp, LOCK_UN);
       fclose($fp);

       echo "<p>Заказ записан.</p>";
    ?>
  </body>
</html>

