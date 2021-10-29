<?php


// phpinfo();

error_reporting(-1);

echo '<pre> HELLO GAYs </pre>';

require '../libs/myDebug.php';
require 'TelegramBot.php';


// Telegram token
const TOKEN = '';

// Telegram API url
const BASE_ULR = 'https://api.telegram.org/bot' . TOKEN . '/';


const START = false;


$boot = new TelegramBot(TOKEN);

$bootUpdate = $boot->sendRequest('getUpdates');

echo ' $boot->sendRequest(getUpdates); ';
debug($bootUpdate);


$bootUpdate = $boot->getUpdates();

echo '$boot->getUpdates();';
debug($bootUpdate);

while (START) {


    //
    $bootUpdate = $boot->getUpdates();

    if (!empty($updates)) {

        //
         file_put_contents(__DIR__ . '/logs.txt', print_r($updates, 1), FILE_APPEND);

        foreach ($updates as $bootUpdate) {

            echo $bootUpdate->message->text . PHP_EOL;

            $boot->sendMessage($bootUpdate->message->chat->id, "Привет, {$bootUpdate->message->from->first_name}! Вы написали: {$bootUpdate->message->text}");
        }
    }

    sleep(3);

}


/*
 * getUpdate() - Этот метод используется для получения обновлений через long polling (wiki).
 * Ответ возвращается в виде массива объектов Update.
*/


/*
 * sendMessage()
 * Use this method to send text messages. On success, the sent Message is returned
 */



/*
 * json_decode() - Декодирует полученную JSON
 * Если true, объекты JSON будут возвращены как ассоциативные массивы (array); если false, объекты JSON будут возвращены как объекты (object).
 * Если null, объекты JSON будут возвращены как ассоциативные массивы (array) или объекты (object) в зависимости от того, установлена ли JSON_OBJECT_AS_ARRAY в flags.
 *
 * file_get_contents() - Читает содержимое файла в строку
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
