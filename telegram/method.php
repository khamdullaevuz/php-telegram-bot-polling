<?php

namespace khamdullaevuz\telegram;

trait Method
{
    public function request($method, $params)
    {
        $url = 'https://api.telegram.org/bot' . config::API_KEY . '/' . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function sendMessage($chat_id, $text)
    {
        $params = [
            'chat_id' => $chat_id,
            'text' => $text
        ];
        $this->request('sendMessage', $params);
    }
}