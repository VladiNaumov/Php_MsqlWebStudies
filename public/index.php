<?php

error_reporting(-1);

// считывания данных с URL браузера
$query = rtrim($_SERVER['QUERY_STRING'], '/');

require '../libs/myDebug.php';

// Telegram token
const TOKEN = '';


// Telegram API url
const BASE_ULR = 'https://api.telegram.org/bot' . TOKEN . '/';



/*
 *Method getUpdate - Этот метод используется для получения обновлений через long polling (wiki).
 * Ответ возвращается в виде массива объектов Update.
*/

// пример получение строки https://api.telegram.org/bot2006101055:AAEE98ckdoAzDCJ5bZBVyV9txN3b-s3HfIQ/getUpdates
$url = BASE_ULR . 'getUpdates';


/*
 * sendMessage
 * Use this method to send text messages. On success, the sent Message is returned
 */

// пример получение строки  https://api.telegram.org/bot2006101055:AAEE98ckdoAzDCJ5bZBVyV9txN3b-s3HfIQ/sendMessage
$send_url = BASE_ULR . 'sendMessage';


/*
 * json_decode - Декодирует полученную JSON
 * Если true, объекты JSON будут возвращены как ассоциативные массивы (array); если false, объекты JSON будут возвращены как объекты (object).
 * Если null, объекты JSON будут возвращены как ассоциативные массивы (array) или объекты (object) в зависимости от того, установлена ли JSON_OBJECT_AS_ARRAY в flags.
 *
 * file_get_contents - Читает содержимое файла в строку
 */


$res = json_decode(file_get_contents($url), false);



if (!empty($res->result)) {
    foreach ($res->result as $item) {
        echo "{$item->message->text}<br><hr>";
        $text = "Вы написали: {$item->message->text}";
        $send_url = BASE_ULR . 'sendMessage';
        $send_url .= "?chat_id={$item->message->chat->id}&text=$text";
        $send = json_decode(file_get_contents($send_url));
        debug($send);
    }
}


//  получение данных chat-id
//$chat_id = $res->result[6]->message->chat->id;



// отправка данных
//$text = " Your send message : {$res->result[6]->message->text}";


/* Допускаются GET и POST запросы. Для передачи параметров в Bot API доступны */

// формирование запроса и отправка сообщение в телеграмм
//$send = json_decode(file_get_contents($send_url . "?chat_id={$chat_id}&text={$text}"));



//debug($send);




/* INFO */

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
