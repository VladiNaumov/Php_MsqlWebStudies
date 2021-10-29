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
    ?>  
  </body>
</html>
