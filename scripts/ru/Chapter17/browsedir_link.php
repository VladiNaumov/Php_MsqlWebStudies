<!DOCTYPE html>
<html>
<head>
   <title>Просмотр каталогов</title>
</head>
<body>
   <h1>Просмотр</h1>

<?php
  $current_dir = '/path/to/uploads/';
  $dir = opendir($current_dir);

  echo '<p>Каталог загрузки: '.$current_dir.'</p>';
  echo '<p>Список файлов в каталоге:</p><ul>';
  
  while(false !== ($file = readdir($dir)))
  {
    // Отбросить две записи - . и ..
    if($file != "." && $file != "..")
       {
         echo '<li><a href="filedetails.php?file='.$file.'">'.$file.'</a></li>';
       }
  }
  echo '</ul>';
  closedir($dir);
?>

</body>
</html>