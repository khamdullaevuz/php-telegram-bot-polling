<?php

namespace khamdullaevuz\telegram;

class Polling extends Core
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

    public function getUpdates($offset)
    {
        $url = 'https://api.telegram.org/bot' . config::API_KEY . '/getUpdates?offset=' . $offset;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function handle()
    {
        $offset = 0;
        while (true) {
            $updates = json_decode($this->getUpdates($offset), true);
            if (count($updates['result']) > 0) {
                foreach ($updates['result'] as $update) {
                    $offset = $update['update_id'] + 1;
                    $this->processUpdate($update);
                }
            }
        }
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