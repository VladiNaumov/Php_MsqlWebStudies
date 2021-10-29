<!DOCTYPE html>
<html>
<head>
   <title>Специальный обработчик ошибок</title>
</head>
<?php
// Функция обработчика ошибок.
function myErrorHandler ($errno, $errstr, $errfile, $errline) {
  echo "<p><strong>ОШИБКА:</strong> ".$errstr."<br/>
        Пожалуйста, повторите попытку или свяжитесь с нами и сообщите,
        что возникла ошибка в строке ".$errline." файла ".$errfile.",
        чтобы мы могли провести дальнейшие исследования.</p>";
 
  if (($errno == E_USER_ERROR) || ($errno == E_ERROR)) {
    echo "<p>Фатальная ошибка. Программа завершается.</p>";
    exit;
  }
 
  echo "<hr/>";
}
 
// Установить обработчик ошибок.
set_error_handler('myErrorHandler');
 
// Инициировать ошибки разных уровней.
trigger_error('Вызвана функция trigger_error.', E_USER_NOTICE);
fopen('nofile', 'r');
trigger_error('Этот компьютер перегрелся.', E_USER_WARNING);
include ('nofile');
trigger_error('Этот компьютер самоуничтожится через 15 секунд.', E_USER_ERROR);
?>