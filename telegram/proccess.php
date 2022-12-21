<?php
namespace khamdullaevuz\telegram;

abstract class Proccess
{
    use Method;
    public function processUpdate($update): void
    {
        $chat_id = $update->message->chat->id;
        $text = $update->message->text;

        if ($text == '/start') {
            $this->sendMessage($chat_id, 'Hello World!');
        }else{
            $this->sendMessage($chat_id, 'I don\'t understand you!');
        }
    }
}