<!DOCTYPE html>
<html>
<head>
  <title>Загрузка...</title>
</head>
<body>
   <h1>Загрузка файла...</h1>

<?php

  if ($_FILES['the_file']['error'] > 0)
  {
    echo 'Проблема: ';
    switch ($_FILES['the_file']['error'])
    {
      case 1:  
         echo 'Размер файла превышает значение upload_max_filesize.';
         break;
      case 2:  
         echo 'Размер файла превышает значение max_file_size.';
         break;
      case 3:  
         echo 'Файл загружен только частично.';
         break;
      case 4:  
         echo 'Файл не был загружен.';
         break;
      case 6:  
         echo 'Не удалось загрузить файл: не указан временный каталог.';
         break;
      case 7:  
         echo 'Загрузка потерпела неудачу: не удалось выполнить запись на диск.';
         break;
      case 8:  
         echo 'Расширение PHP заблокировало загрузку файла.';
         break;
    }
    exit;
  }

  // Имеет ли файл правильный тип MIME?
  if ($_FILES['the_file']['type'] != 'image/png')
  {
    echo 'Проблема: файл не является изображением PNG.';
    exit;
  }

  // Поместить файл в желаемое место.
  $uploaded_file = '/filesystem/path/to/uploads/'.$_FILES['the_file']['name'];

  if (is_uploaded_file($_FILES['the_file']['tmp_name']))
  {
     if (!move_uploaded_file($_FILES['the_file']['tmp_name'], $uploaded_file))
     {
        echo 'Проблема: не удалось переместить файл в целевой каталог.';
        exit;
     }
  }
  else
  {
    echo 'Проблема: возможная атака через загрузку файла. Имя файла: ';
    echo $_FILES['the_file']['name'];
    exit;
  }

  echo 'Файл успешно загружен.';

  // Показать, что было загружено.
  echo '<p>Вы загрузили следующее изображение:<br/>';
  echo '<img src="/uploads/'.$_FILES['the_file']['name'].'"/>';
?>
</body>
</html>