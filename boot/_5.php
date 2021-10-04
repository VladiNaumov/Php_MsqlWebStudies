<?php



error_reporting(-1);

// считывания данных с URL браузера
$query = rtrim($_SERVER['QUERY_STRING'], '/');

require '../libs/myDebug.php';



const TOKEN = '2006101055:AAEE98ckdoAzDCJ5bZBVyV9txN3b-s3HfIQ';

const BASE_ULR = 'https://api.telegram.org/bot' . TOKEN . '/';

$url = BASE_ULR . 'getUpdates';

$send_url = BASE_ULR . 'sendMessage';



$res = json_decode(file_get_contents($url), false);

$chat_id = $res->result[0]->message->chat->id;

$text = " Your send message : {$res->result[0]->message->text}";

$send = json_decode(file_get_contents($send_url . "?chat_id={$chat_id}&text={$text}"));



debug($send);
debug($res);



/*
 *json_decode - Декодирует строку JSON
 * Если true, объекты JSON будут возвращены как ассоциативные массивы (array); если false, объекты JSON будут возвращены как объекты (object).
 * Если null, объекты JSON будут возвращены как ассоциативные массивы (array) или объекты (object) в зависимости от того, установлена ли JSON_OBJECT_AS_ARRAY в flags.
 *
 * file_get_contents - Читает содержимое файла в строку
 */



/*
 * Дваеточие - это обращение к статическому методу
 * Ruoter::dispatch($query);
 *
 * $DEMO = new DemoDemo();
 * $DEMO->myDemo();
 * $DEMO->myDemo();
 *
 * Дваеточие - это обращение к статическому методу
 * $DEMO::myStaticDemo();
 */
