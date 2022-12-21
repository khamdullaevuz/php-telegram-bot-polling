<?php

namespace khamdullaevuz\telegram;

class Polling
{
    use \Proccess;
    public function getUpdates($offset)
    {
        $url = 'https://api.telegram.org/bot' . \Config::API_KEY . '/getUpdates?offset=' . $offset;
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
            $updates = json_decode($this->getUpdates($offset));
            if (count($updates->result) > 0) {
                foreach ($updates->result as $update) {
                    $offset = $update->update_id + 1;
                    $this->processUpdate($update);
                }
            }
        }
    }
}