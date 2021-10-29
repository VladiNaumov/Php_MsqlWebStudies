<!DOCTYPE html>
<html>
<head>
  <title>Сведения о файле</title>
</head>
<body>
<?php
  
  if (!isset($_GET['file'])) 
  {
     echo "Вы не указали имя файла.";
  } 
  else {
     $uploads_dir = '/path/to/uploads/';
 
     // В целях безопасности отбросить информацию о каталоге.
     $the_file = basename($_GET['file']);  
 
     $safe_file = $uploads_dir.$the_file;
 
     echo '<h1>Сведения о файле: '.$the_file.'</h1>';
 
     echo '<h2>Данные о файле</h2>';
     echo 'Время последнего доступа к файлу: '.date('j F Y H:i', fileatime($safe_file)).'<br/>';
     echo 'Время последнего изменения файла: '.date('j F Y H:i', filemtime($safe_file)).'<br/>';
 
     $user = posix_getpwuid(fileowner($safe_file));
     echo 'Владелец файла: '.$user['name'].'<br/>';
  
     $group = posix_getgrgid(filegroup($safe_file));
     echo 'Группа файла: '.$group['name'].'<br/>';
 
     echo 'Разрешения файла: '.decoct(fileperms($safe_file)).'<br/>';
     echo 'Тип файла: '.filetype($safe_file).'<br/>';
     echo 'Размер файла: '.filesize($safe_file).' bytes<br>';
 
     echo '<h2>Анализ файла</h2>';
     echo 'is_dir: '.(is_dir($safe_file)? 'true' : 'false').'<br/>';
     echo 'is_executable: '.(is_executable($safe_file)? 'true' : 'false').'<br/>';
     echo 'is_file: '.(is_file($safe_file)? 'true' : 'false').'<br/>';
     echo 'is_link: '.(is_link($safe_file)? 'true' : 'false').'<br/>';
     echo 'is_readable: '.(is_readable($safe_file)? 'true' : 'false').'<br/>';
     echo 'is_writable: '.(is_writable($safe_file)? 'true' : 'false').'<br/>';
  }
?>
</body>
</html>