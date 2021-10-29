<?php
// Установить дату для вычисления
$day = 18;
$month = 9;
$year = 1972;
 
// Сформатировать дату рождения в виде даты ISO-8601
$bdayISO = date("c", mktime (0, 0, 0, $month, $day, $year));
 
// Использовать запрос MySQL для вычисления возраста в днях
$db = mysqli_connect('localhost', 'user', 'pass');
$res = mysqli_query($db, "select datediff(now(), '$bdayISO')");
$age = mysqli_fetch_array($res);
 
// Преобразовать возраст в днях в возраст в годах (приблизительно)
echo 'Current age is '.floor($age[0]/365.25).'.';
?>