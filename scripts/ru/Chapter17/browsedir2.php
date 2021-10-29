<!DOCTYPE html>
<html>
<head>
   <title>Просмотр каталогов</title>
</head>
<body>
   <h1>Просмотр</h1>

<?php
  $dir = dir("/path/to/uploads/");
 
  echo '<p>Дескриптор: '.$dir->handle.'</p>';
  echo '<p>Каталог загрузки: '.$dir->path.'</p>';
  echo '<p>Список файлов в каталоге:</p><ul>';
  
  while(false !== ($file = $dir->read()))
    // Отбросить две записи: . и ..
    if($file != "." && $file != "..")
       {
         echo '<li>'.$file.'</li>';
       }
       
  echo '</ul>';
  $dir->close();
?>
 
</body>
</html>