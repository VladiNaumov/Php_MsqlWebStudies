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

        //  формирование строк запроса base_url . $token . '/';
        $this->base_url .= $token . '/';
    }

    //  формирование строк запроса
    public function sendRequest($method, $params = [])
    {
        // формирование строки запроса
        $url = $this->base_url . $method;

        // если есть дополнительные параметры мы их добовляем в строку запоса
        if (!empty($params)) {

            // если есть дополнительные параметры мы их добовляем в строку запоса

            // http_build_query — Генерирует URL-кодированную строку запроса
            $url .= '?' . http_build_query($params);
            // пример полученной строки в переменной $url https://api.telegram.org/BOT_TOKEN/getUpdates?offset=860099836
        }
        return json_decode(file_get_contents($url));
    }

    public function getUpdates()
    {
        $params = [];
        if (!empty($this->update_id)) {
            $params = [
                'offset' => $this->update_id + 1,
            ];
        }
        $res = ($this->sendRequest('getUpdates', $params))->result;
        if (!empty($res)) {
            $this->update_id = $res[count($res) - 1]->update_id;
        }
        return $res;
    }

    public function sendMessage($chat_id, $text, $params = [])
    {
        return $this->sendRequest('sendMessage', [
            'chat_id' => $chat_id,
            'text' => $text,
        ]);
    }

    public function sendPhoto()
    {

    }

}