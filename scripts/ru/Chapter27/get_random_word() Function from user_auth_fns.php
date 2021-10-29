function get_random_word($min_length, $max_length) {
// Извлекает из словаря случайное слово длиной
// от min_length до max_length и возвращает его.
 
  // Сгенерировать случайное слово.
  $word = '';
  // Не забудьте привести этот путь в соответствие со своей системой.
  $dictionary = '/usr/dict/words';  // словарь ispell
  $fp = @fopen($dictionary, 'r');
  if(!$fp) {
    return false;
  }
  $size = filesize($dictionary);
 
  // Перейти к случайному местоположению в словаре.
  $rand_location = rand(0, $size);
  fseek($fp, $rand_location);
 
  // Получить из файла следующее полное слово подходящей длины.
  while ((strlen($word) < $min_length) || (strlen($word)>$max_length) || (strstr($word, "'"))) {
     if (feof($fp)) {
        fseek($fp, 0);        // если достигнут конец файла, то перейти в его начало
     }
     $word = fgets($fp, 80);  // пропустить первое слово, т.к. оно может быть неполным
     $word = fgets($fp, 80);  // потенциальное слово для пароля
  }
  $word = trim($word);        // отбросить завершающий символ \n из результата fgets()
  return $word;
}