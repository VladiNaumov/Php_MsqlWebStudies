<!DOCTYPE html>
<html>
<head>
   <title>Котировки акций из NASDAQ</title>
</head>
<body>
 
<?php
// Выбрать компанию для просмотра котировок акций
$symbol = 'GOOG';
echo '<h1>Котировки акций для '.$symbol.'</h1>';
 
$url = 'http://download.finance.yahoo.com/d/quotes.csv' .
    '?s='.$symbol.'&e=.csv&f=sl1d1t1c1ohgv';
 
if (!($contents = file_get_contents($url))) {
    die('Не удалось открыть '.$url);
}
 
// Извлечь необходимые данные
list($symbol, $quote, $date, $time) = explode(',', $contents);
$date = trim($date, '"');
$time = trim($time, '"');
 
echo '<p>Акции '.$symbol.' продавались по $'.$quote.'</p>';
echo '<p>Котировки актуальны на момент '.$date.' at '.$time.'</p>';
 
// Указать источник
echo '<p>Эта информация извлечена из <br /><a href="'.$url.'">'.$url.'</a>.</p>';
 
?>
</body>
</html>