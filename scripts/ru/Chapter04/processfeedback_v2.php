<?php

// создать короткие имена переменных
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$feedback = trim($_POST['feedback']);

// настроить статическую информацию
$toaddress = "feedback@example.com";

$subject = "Отзыв из веб-сайта";

$mailcontent = "Имя клиента: ".str_replace("\r\n", "", $name)."\n".
               "Адрес электронной почты клиента: ".str_replace("\r\n", "",$email)."\n".
               "Комментарии клиента:\n".str_replace("\r\n", "",$feedback)."\n";

$fromaddress = "From: webserver@example.com";

// вызвать функцию mail() для отправки электронной почты
mail($toaddress, $subject, $mailcontent, $fromaddress);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Автозапчасти от Вовки - Отзыв отправлен</title>
  </head>
  <body>

    <h1>Отзыв отправлен</h1>
    <p>Ваш отзыв (показанный ниже) был отправлен.</p>
	<p><?php echo nl2br(htmlspecialchars($feedback)); ?> </p>
  </body>
</html>