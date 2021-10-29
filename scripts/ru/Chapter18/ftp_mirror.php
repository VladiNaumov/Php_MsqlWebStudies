<!DOCTYPE html>
<html>
<head>
   <title>Зеркальное обновление</title>
</head>
<body>
   <h1>Зеркальное обновление</h1>
 
<?php
// Установить переменные - измените значения согласно своим условиям
$host = 'apache.cs.utah.edu';
$user = 'anonymous';
$password = 'me@example.com';
$remotefile = '/apache.org/httpd/httpd-2.4.25.tar.gz';
$localfile = '/path/to/files/httpd-2.4.25.tar.gz';
 
// Подключиться к хосту
$conn = ftp_connect($host);
 
if (!$conn)
{
  echo 'Ошибка: не удалось подключиться к '.$host;
  exit;
}
 
echo 'Подключение к '.$host.' установлено<br />';
 
// Войти на хост
$result = @ftp_login($conn, $user, $pass);
if (!$result)
{
  echo 'Ошибка: не удалось войти как '.$user;
  ftp_quit($conn);
  exit;
}
 
echo 'Успешный вход как '.$user.'<br />';
 
// Включить пассивный режим
ftp_pasv($conn, true); 
 
// Проверить время файла, чтобы выяснить, требуется ли обновление
echo 'Проверка времени файла...<br />';
if (file_exists($localfile))
{
  $localtime = filemtime($localfile);
  echo 'Время последнего обновления локального файла: ';
  echo date('G:i j-M-Y', $localtime);
  echo '<br />';
}
else
{
  $localtime = 0;
}
 
$remotetime = ftp_mdtm($conn, $remotefile);
if (!($remotetime >= 0))
{
   // Это не означает отсутствие файла, просто сервер
   // может не поддерживать время модификации
   echo 'Не удалось получить время удаленного файла.<br />';
   $remotetime = $localtime+1;  // обеспечить обновление
}
else
{
  echo 'Время последнего обновления удаленного файла: ';
  echo date('G:i j-M-Y', $remotetime);
  echo '<br />';
}
 
if (!($remotetime > $localtime))
{
   echo 'Локальная копия актуальна.<br />';
   exit;
}
 
// Загрузить файл
echo 'Получение файла из сервера...<br />';
$fp = fopen($localfile, 'wb');
 
if (!$success = ftp_fget($conn, $fp, $remotefile, FTP_BINARY))
{
  echo 'Ошибка: не удалось загрузить файл.';
  ftp_quit($conn);
  exit;
}
 
fclose($fp);
echo 'Файл успешно загружен.';
 
// Закрыть подключение к хосту
ftp_close($conn);
 
?>
</body>
</html>