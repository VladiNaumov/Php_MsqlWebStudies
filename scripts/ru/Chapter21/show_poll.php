<?php

// Проверить наличие данных в переменной. 
$vote = $_POST['vote'];

if (empty($vote))
{
  echo '<p>Вы не проголосовали за какого-нибудь политика.</p>';
  exit;
}

/********************************************************
  Запрос базы данных для получения информации о голосах
********************************************************/

// Войти в базу данных.
//$db = new mysqli('localhost', 'poll', 'poll', 'poll');
$db = new mysqli('tester.cynw5brug1nx.us-east-1.rds.amazonaws.com', 'tester_admin', 'pekoemini!!!!!', 'poll');
if (mysqli_connect_errno()) {
    echo '<p>Ошибка: не удалось подключиться к базе данных.<br/>
    Пожалуйста, повторите попытку позже.</p>';
    exit;
}

// Добавить голос пользователя.
$v_query = "UPDATE poll_results 
            SET num_votes = num_votes + 1 
            WHERE candidate = ?";
$v_stmt = $db->prepare($v_query);
$v_stmt->bind_param('s', $vote);  
$v_stmt->execute();
$v_stmt->free_result();

// Получить текущие результаты голосования.
$r_query = "SELECT candidate, num_votes FROM poll_results";
$r_stmt = $db->prepare($r_query);
$r_stmt->execute();
$r_stmt->store_result();
$r_stmt->bind_result($candidate, $num_votes);
$num_candidates = $r_stmt->num_rows;

// Вычислить общее количество голосов до сих пор. 
$total_votes = 0;

while ($r_stmt->fetch())
{    
    $total_votes +=  $num_votes;
}

$r_stmt->data_seek(0);

/********************************************************
  Начальные вычисления для диаграммы
********************************************************/
// Настроить константы.
putenv('GDFONTPATH=/usr/share/fonts/truetype/dejavu');

$width = 500;        // ширина изображения в пикселях
$left_margin = 50;   // отступ слева от диаграммы
$right_margin= 50;   // отступ справа от диаграммы
$bar_height = 40;
$bar_spacing = $bar_height/2;
$font_name = 'DejaVuSans';
$title_size= 16;     // в пунктах
$main_size= 12;      // в пунктах
$small_size= 12;     // в пунктах
$text_indent = 10;   // позиция текстовых надписей от края изображения

// Настроить начальную точку для рисования.
$x = $left_margin + 60;  // место для рисования базовой линии диаграммы
$y = 50;                 // то же самое
$bar_unit = ($width-($x+$right_margin)) / 100;   // одна "единица" на диаграмме

// Вычислить высоту диаграммы - полосы плюс промежутки плюс поле.
$height = $num_candidates * ($bar_height + $bar_spacing) + 50;

/********************************************************
  Настройка базового изображения
********************************************************/
// Создать пустой холст.
$im = imagecreatetruecolor($width,$height);

// Назначить цвета.
$white = imagecolorallocate($im,255,255,255);
$blue = imagecolorallocate($im,0,64,128);
$black = imagecolorallocate($im,0,0,0);
$pink = imagecolorallocate($im,255,78,243);

$text_color = $black;
$percent_color = $black;
$bg_color = $white;
$line_color = $black;
$bar_color = $blue;
$number_color = $pink;

// Создать "холст" для рисования.
imagefilledrectangle($im, 0, 0, $width, $height, $bg_color);

// Нарисовать контур вокруг холста.
imagerectangle($im, 0, 0, $width-1, $height-1, $line_color);

// Добавить заголовок.
$title = 'Результаты опроса';
$title_dimensions = imagettfbbox($title_size, 0, $font_name, $title);
$title_length = $title_dimensions[2] - $title_dimensions[0];
$title_height = abs($title_dimensions[7] - $title_dimensions[1]);
$title_above_line = abs($title_dimensions[7]);
$title_x = ($width-$title_length)/2;  // центрировать по x
$title_y = ($y - $title_height)/2 + $title_above_line; // центрировать по y

imagettftext($im, $title_size, 0, $title_x, $title_y,
             $text_color, $font_name, $title);

// Нарисовать базовую линию, начиная чуть выше позиции первой полосы
// и заканчивая чуть ниже последней полосы.
imageline($im, $x, $y-5, $x, $height-15, $line_color);

/********************************************************
  Рисование графического представления данных
********************************************************/
// Получить строки из таблицы базы данных и нарисовать соответствующие полосы.

while ($r_stmt->fetch())
{

  if ($total_votes > 0) {
    $percent = intval(($num_votes/$total_votes)*100);
  } else {
    $percent = 0;
  }

 // Отобразить процент для этого значения.
 $percent_dimensions = imagettfbbox($main_size, 0, $font_name, $percent.'%');

 $percent_length = $percent_dimensions[2] - $percent_dimensions[0];

 imagettftext($im, $main_size, 0, $width-$percent_length-$text_indent,
               $y+($bar_height/2), $percent_color, $font_name, $percent.'%');

 // Длина полосы для этого значения.
 $bar_length = $x + ($percent * $bar_unit);

 // Нарисовать полосу для этого значения.
 imagefilledrectangle($im, $x, $y-2, $bar_length, $y+$bar_height, $bar_color);

 // Нарисовать заголовок для этого значения.
 imagettftext($im, $main_size, 0, $text_indent, $y+($bar_height/2),
              $text_color, $font_name, $candidate);

 // Нарисовать контур, показывающий 100%.
 imagerectangle($im, $bar_length+1, $y-2,
                ($x+(100*$bar_unit)), $y+$bar_height, $line_color);

 // Отобразить числа.
 imagettftext($im, $small_size, 0, $x+(100*$bar_unit)-50, $y+($bar_height/2),
               $number_color, $font_name, $num_votes.'/'.$total_votes);

 // Перейти вниз на следующую полосу.
 $y=$y+($bar_height+$bar_spacing);

}

/********************************************************
  Вывод изображения
********************************************************/
header('Content-type:  image/png');
imagepng($im);

/********************************************************
  Очистка ресурсов
********************************************************/
$r_stmt->free_result();
$db->close();
imagedestroy($im);
?>