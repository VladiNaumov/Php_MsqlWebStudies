<?php
  // создать короткие имена переменных
  $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Автозапчасти от Вовки - Заказы клиентов</title>
  </head>
  <body>
    <h1>Автозапчасти от Вовки</h1>
    <h2>Заказы клиентов</h2> 
    <?php
      @$fp = fopen("$document_root/../orders/orders.txt", 'rb');
      flock($fp, LOCK_SH); // заблокировать файл для чтения

      if (!$fp) {
        echo "<p><strong>Ожидающие заказы отсутствуют.<br />
              Пожалуйста, попробуйте позже.</strong></p>";
        exit;
      }

      while (!feof($fp)) {
         $order= fgets($fp);
         echo htmlspecialchars($order)."<br />";
      }

      flock($fp, LOCK_UN); // освободить блокировку чтения

      echo 'Конечная позиция указателя файла: '.(ftell($fp));
      echo '<br />';
      rewind($fp);
      echo 'Позиция после вызова rewind(): '.(ftell($fp));
      echo '<br />';

      fclose($fp); 

    ?>
  </body>
</html>