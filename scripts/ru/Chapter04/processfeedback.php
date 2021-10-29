<?php

// создать короткие имена переменных
$name=$_POST['name'];
$email=$_POST['email'];
$feedback=$_POST['feedback'];

// настроить статическую информацию
$toaddress = "feedback@example.com";

$subject = "Отзыв из веб-сайта";

$mailcontent = "Имя клиента: ".filter_var($name)."\n".
               "Адрес электронной почты клиента: ".$email."\n".
               "Комментарии клиента:\n".$feedback."\n";

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
    <p>Ваш отзыв был отправлен.</p>

  </body>
</html>