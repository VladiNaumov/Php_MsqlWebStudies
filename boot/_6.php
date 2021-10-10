<?php


error_reporting(-1);


require '../libs/myDebug.php';

// Telegram token
const TOKEN = '';

// Telegram API url
const BASE_ULR = 'https://api.telegram.org/bot' . TOKEN . '/';


const START = false;

while (START) {

    $url = BASE_ULR . 'getUpdates';
    if (isset($last_update)) {
        $params = [
            // передаём последний update_ID что бы сказать телеграмму что сообщение получено и прочитано
            'offset' => $last_update + 1,
        ];

        // http_build_query() -> Генерирует URL-кодированную строку запроса из предоставленного ассоциативного (или индексированного) массива.
        $url .= '?' . http_build_query($params);

        // https://api.telegram.org/BOT_TOKEN/getUpdates?offset=860099807

    }


    $res = json_decode(file_get_contents($url));

    // send message
    if (!empty($res->result)) {
        file_put_contents(__DIR__ . '/logs.txt', print_r($res, 1), FILE_APPEND);

        foreach ($res->result as $item) {

            echo $item->message->text . PHP_EOL;

            $last_update = $item->update_id;
            $send_url = BASE_ULR . 'sendMessage';

            $send_params = [
                'chat_id' => $item->message->chat->id,
                'text' => "Вы написали: {$item->message->text}",
            ];

            $send_url .= "?" . http_build_query($send_params);

            $send = json_decode(file_get_contents($send_url));
        }
    }

    sleep(10);

}

/*
 *Method getUpdate - Этот метод используется для получения обновлений через long polling (wiki).
 * Ответ возвращается в виде массива объектов Update.
*/


/*
 * sendMessage
 * Use this method to send text messages. On success, the sent Message is returned
 */



/*
 * json_decode - Декодирует полученную JSON
 * Если true, объекты JSON будут возвращены как ассоциативные массивы (array); если false, объекты JSON будут возвращены как объекты (object).
 * Если null, объекты JSON будут возвращены как ассоциативные массивы (array) или объекты (object) в зависимости от того, установлена ли JSON_OBJECT_AS_ARRAY в flags.
 *
 * file_get_contents - Читает содержимое файла в строку
 */




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
