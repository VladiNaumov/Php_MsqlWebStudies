<!DOCTYPE html>
<html>
  <head>
   <title>Автозапчасти от Вовки - Стоимость доставки</title>
  </head>
  <body>
    <table style="border: 0px; padding: 3px">
    <tr>
     <td style="background: #cccccc; text-align: center;">Расстояние</td>
     <td style="background: #cccccc; text-align: center;">Стоимость</td>
    </tr>

    <?php
    $distance = 50;
    while ($distance <= 250) {
      echo "<tr>
            <td style=\"text-align: right;\">".$distance."</td>
            <td style=\"text-align: right;\">".($distance / 10)."</td>
            </tr>\n";
      $distance += 50;
    }
    ?>
    
    </table>
  </body>
</html>