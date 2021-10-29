<?php
// Проверить наличие данных в соответствующих переменных.
// (button_text и button_color)
 
$button_text = $_POST['button_text'];
$button_color = $_POST['button_color'];
 
if (empty($button_text) || empty($button_color))
{
  echo '<p>Не удалось создать изображение: форма не была корректно заполнена.</p>';
  exit;
}
 
// Создать изображение, используя правильный цвет кнопки, и проверить размер.
$im = imagecreatefrompng($button_color.'-button.png');
 
$width_image = imagesx($im);
$height_image = imagesy($im);
 
// Изображению нужен отступ 18 пикселей от края.
$width_image_wo_margins = $width_image - (2 * 18);
$height_image_wo_margins = $height_image - (2 * 18);
 
// Указать GD2, где находится шрифт, который желательно применять.
 
// Для Windows используйте:
// putenv('GDFONTPATH=C:\WINDOWS\Fonts'); 
 
// Для UNIX применяйте полный путь к каталогу шрифтов.
// В этом примере используется семейство шрифтов DejaVu:
putenv('GDFONTPATH=/usr/share/fonts/truetype/dejavu'); 
 
$font_name = 'DejaVuSans';
 
// Выяснить, подходит ли размер шрифта, и уменьшать до тех пор, пока не подойдет.
// Начать с наибольшего размера, который подойдет для кнопки.
$font_size = 33;
 
do
{
  $font_size--;
 
  // Вычислить размер текста при таком размере шрифта.
  $bbox = imagettfbbox($font_size, 0, $font_name, $button_text);
 
  $right_text = $bbox[2]; // правая координата
  $left_text = $bbox[0];  // левая координата
  $width_text = $right_text - $left_text;   // ширина текста
  $height_text = abs($bbox[7] - $bbox[1]);  // высота текста
   
} while ($font_size > 8 &&
         ($height_text > $height_image_wo_margins ||
          $width_text > $width_image_wo_margins)
        );
 
if ($height_text > $height_image_wo_margins ||
     $width_text > $width_image_wo_margins) 
{
  // Подходящий читабельный размер шрифта для кнопки отсутствует.
  echo '<p>Предоставленный текст не помещается на кнопке.</p>';
} 
else
{
  // Подходящий размер шрифта найден.
  // Выяснить, где разместить текст.
 
  $text_x = $width_image / 2.0 - $width_text / 2.0;
  $text_y = $height_image / 2.0 - $height_text / 2.0 ;
 
  if ($left_text < 0)
  {
    $text_x += abs($left_text);     // дополнительный коэффициент для левого выступа
  }
 
  $above_line_text = abs($bbox[7]); // расстояние до базовой линии
  $text_y += $above_line_text;      // дополнительный коэффициент для базовой линии
  
  $text_y -= 2;  // корректирующий коэффициент для формы шаблона
 
  $white = imagecolorallocate ($im, 255, 255, 255);
 
  imagettftext ($im, $font_size, 0, $text_x, $text_y, $white, 
                $font_name, $button_text);
 
  header('Content-type: image/png');
  imagepng ($im);
}
 
// Очистить ресурсы.
imagedestroy ($im);
?>