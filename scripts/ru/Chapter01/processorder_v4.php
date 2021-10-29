<?php
  // создать короткие имена переменных
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
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
    echo "<p>Заказ обработан в ";
    echo date('H:i, jS F Y');
    echo "</p>";

    echo '<p>Ваш заказ: </p>';

    echo htmlspecialchars($tireqty).' шин<br />';
    echo htmlspecialchars($oilqty).' бутылок масла<br />';
    echo htmlspecialchars($sparkqty).' свечей зажигания<br />';

    $totalqty = 0;
    $totalqty = $tireqty + $oilqty + $sparkqty;
    echo "<p>Заказано товаров: ".$totalqty."<br />";
    $totalamount = 0.00;

    define('TIREPRICE', 100);
    define('OILPRICE', 10);
    define('SPARKPRICE', 4);

    $totalamount = $tireqty * TIREPRICE
                 + $oilqty * OILPRICE
                 + $sparkqty * SPARKPRICE;

    echo "Итого: $".number_format($totalamount,2)."<br />";
    
    $taxrate = 0.10;  // местный налог с продаж составляет 10%
    $totalamount = $totalamount * (1 + $taxrate);
    echo "Всего, включая налог с продаж: $".number_format($totalamount,2)."</p>";
    ?>  
  </body>
</html>
