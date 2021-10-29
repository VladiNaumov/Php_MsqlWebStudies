<!DOCTYPE html>
<html>
<head>
   <title>Просмотр каталогов</title>
</head>
<body>
   <h1>Просмотр</h1>

<?php
$dir = '/path/to/uploads/';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);
 
echo '<p>Каталог загрузки: '.$dir.'</p>';
echo '<p>Список файлов в каталоге в алфавитном порядке по возрастанию:</p><ul>';
 
foreach($files1 as $file)
{
   if ($file != "." && $file != "..")
   {
     echo '<li>'.$file.'</li>';
   }
}
 
echo '</ul>';
 
echo '<p>Каталог загрузки: '.$dir.'</p>';
echo '<p>Список файлов в каталоге в алфавитном порядке по убыванию:</p><ul>';
 
foreach($files2 as $file)
{
   if ($file != "." && $file != "..")
   {
     echo '<li>'.$file.'</li>';
   }
}
 
echo '</ul>';
 
?>
</body>
</html>