<?php

declare(strict_types=1);

use GuzzleHttp\Client;

class sendMessage {

    private $tgApi;
    private $client;
    private $token;
    private $user;

    public function __construct()
    {
        $this->token = "7304580083:AAElYIaMH64ZPgXkFhgPpYGOA_JgWec3pUs";
        $this->tgApi = "https://api.telegram.org/bot$this->token/";
        $this->client = new Client(['base_uri' => $this->tgApi]);
        $this->user = new User();
    }

    public function startHandler(int $chatId) {

        if ($this->user->sendChatId($chatId) != $chatId) {
            $this->user->saveUser($chatId);
        }

        $this->client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => 'Welcome to my Notes Telegram bot'
            ]
        ]);
    }

    public function addHandler(int $chatId) {
        $this->user->saveCommand($chatId, 'add');

        $this->client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => "Enter the text"
            ]
        ]);
    }

    public function getHandler($target, int $chatId) {
        $this->client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => print_r($target, true)
            ]
        ]);
    }

    public function checkHandler(int $chatId) {
        $this->user->saveCommand($chatId, 'check');

        $this->client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => "Enter the text 'add'"
            ]
        ]);
    }

    public function uncheckHandler(int $chatId) {
        $this->user->saveCommand($chatId, 'uncheck');

        $this->client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => "Enter the text 'add'"
            ]
        ]);
    }

    public function deleteHandler(int $chatId) {
        $this->user->saveCommand($chatId, 'delete');

        $this->client->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => "Enter the text 'add'"
            ]
        ]);
    }

}