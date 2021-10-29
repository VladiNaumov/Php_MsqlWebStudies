<?php

// Урок 9.Class TelegramBoot

// phpinfo();

class TelegramBot
{

    protected string $token;

    protected string $base_url = 'https://api.telegram.org/bot';

    public int $update_id;

    public function __construct($token)
    {
        $this->token = $token;

        //  формирование строк запроса https://api.telegram.org/BOT_TOKEN /
        $this->base_url .= $token . '/';
    }

    //  формирование строк запроса и возвращает сам запрос в виде закодированную в JSON строку и преобразует её в Ассоциативный массив PHP
    public function sendRequest($method, $params = [])
    {
        // формирование строки запроса
        $url = $this->base_url . $method;

        // если есть дополнительные параметры мы их добовляем в строку запроса
        if (!empty($params)) {

            // если есть дополнительные параметры мы их добовляем в строку запроса

            // http_build_query — Генерирует URL-кодированную строку запроса из предоставленного ассоциативного (или индексированного) массива.
            $url .= '?' . http_build_query($params);
            // пример полученной строки в переменной $url https://api.telegram.org/BOT_TOKEN/getUpdates?offset=860099836
        }

       /*
        * file_get_contents — Принимает содержимое JSON файла.
        * json_decode- Принимает содержимое JSON и преобразует её в Ассоциативный массив PHP
       */


        return json_decode(file_get_contents($url));

    }


    // getUpdate() - Этот метод используется для получения обновлений. Ответ возвращается в виде массива объектов Update.
    public function getUpdates()
    {
        $params = [];

        // если не пусто свойства update_id
        if (!empty($this->update_id)) {
            $params = [
                // 'offset' этим мы говорим телеграмму что сообщение прочитано и не нужно прошлое сообщение высылать опять
                'offset' => $this->update_id + 1,
            ];
        }

        //вызов метода в своём классе sendRequest
        $res = ($this->sendRequest('getUpdates', $params))->result;

        if (!empty($res)) {

            $this->update_id = $res[count($res) - 1]->update_id;
        }
        return $res;
    }

    public function sendMessage($chat_id, $text, $params = [])
    {
        //вызов метода в своём классе sendRequest
        return $this->sendRequest('sendMessage', [

            // передача сообщения в виде массива. Какому чату передать сообщение ('chat_id' => $chat_id,) и само сообщение ('text' => $text)
            'chat_id' => $chat_id,
            'text' => $text,
        ]);
    }

    public function sendPhoto()
    {

    }

    // KLO 12:26

    /* INFO */

   /*
    *
    * Method getUpdate - Этот метод используется для получения обновлений через long polling (wiki).
    * Ответ возвращается в виде массива объектов Update.
    *
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




}