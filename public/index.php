<?php

// Урок 8.Функция отправки запросов

// phpinfo();

error_reporting(-1);

echo 'HELLO GAYs';

require '../libs/myDebug.php';

// Telegram token
const TOKEN = '';

// Telegram API url
const BASE_ULR = 'https://api.telegram.org/bot' . TOKEN . '/';


const START = true;

while (START) {

    //Функция isset() позволяет определить, инициализирована ли переменная или нет. Если переменная определена, то isset() возвращает значение true.
    if (isset($last_update)) {

        $params = [
            // формирует ответ в телеграмм, что сообщение прочитано
            'offset' => $last_update + 1,
        ];
    } else {
        $params = [];
    }

    $updates = send_request('getUpdates', $params);

    if (!empty($updates->result)) {

        // file_put_contents — Пишет данные в файл
        // Если filename не существует, файл будет создан. Иначе, существующий файл будет перезаписан, за исключением случая, если указан флаг FILE_APPEND.
        file_put_contents(__DIR__ . '/logs.txt', print_r($updates, 1), FILE_APPEND);

        // проход по ассациативнуму массиву
        foreach ($updates->result as $update) {

            // PHP_EOL - делает корректный символ конца строки
            echo $update->message->text . PHP_EOL;

            $last_update = $update->update_id;


            send_request('sendMessage',
            [
                'chat_id' => $update->message->chat->id,
                'text' => "Привет, {$update->message->from->first_name}! Вы написали: {$update->message->text}",
            ]);

        }
    }

    sleep(3);
}

// Функция формирование строк запроса
function send_request($method, $params = [])
{
    // формирование строки запроса


    $url = BASE_ULR . $method;

    if (!empty($params)) {

        // если есть дополнительные параметры мы их добовляем в строку запоса

        // http_build_query — Генерирует URL-кодированную строку запроса

        $url = BASE_ULR . $method . '?' . http_build_query($params);

        // пример полученной строки в переменной $url https://api.telegram.org/TOKEN/getUpdates?offset=860099836
    }
    return json_decode(file_get_contents($url));
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
