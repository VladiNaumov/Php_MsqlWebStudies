<?php
  // создать короткие имена переменных
  $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Автозапчасти от Вовки - Заказы клиентов</title>

    <style type="text/css">
    table, th, td {
      border-collapse: collapse;
      border: 1px solid black;
      padding: 6px;
    }

    th {
      background: #ccccff;      
    }
    </style>

  </head>
  <body>
    <h1>Автозапчасти от Вовки</h1>
    <h2>Заказы клиентов</h2> 

    <?php
      // Прочитать весь файл целиком.
      // Каждый заказ становится элементом массива.
      $orders= file("$document_root/../orders/orders.txt");
    
      // подсчитать количество заказов в массиве
      $number_of_orders = count($orders);
    
      if ($number_of_orders == 0) {
        echo "<p><strong>Ожидающие заказы отсутствуют.<br />
              Пожалуйста, попробуйте позже.</strong></p>";
      }
    
      echo "<table>\n";
      echo "<tr>
              <th>Дата заказа</th>
              <th>Шины</th>
              <th>Масло</th>
              <th>Свечи зажигания</th>
              <th>Всего</th>
              <th>Адрес</th>
            <tr>";
    
      for ($i=0; $i<$number_of_orders; $i++) {
        // разбить каждую строку
        $line = explode("\t", $orders[$i]);
    
        // сохранить только количества заказанных товаров
        $line[1] = intval($line[1]);
        $line[2] = intval($line[2]);
        $line[3] = intval($line[3]);
    
        // вывести каждый заказ
        echo "<tr>
              <td>".$line[0]."</td>
              <td style=\"text-align: right;\">".$line[1]."</td>
              <td style=\"text-align: right;\">".$line[2]."</td>    
              <td style=\"text-align: right;\">".$line[3]."</td>
              <td style=\"text-align: right;\">".$line[4]."</td>
              <td>".$line[5]."</td>
          </tr>";
      }    
      echo "</table>";
    ?>
  </body>
</html>