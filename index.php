<?php

require "vendor/autoload.php";

$update = json_decode(file_get_contents('php://input'));

$sendMessage = new sendMessage();
$note = new Note();

if (isset($update) && isset($update->message) && isset($update->update_id)) {

    $message = $update->message;
    $chat_id = $message->chat->id;
    $text = $message->text;

    if ($text === '/start') {
        $sendMessage->startHandler($chat_id);
        return;
    }

    if ($text === '/add') {
        $sendMessage->addHandler($chat_id);
        return;
    }

    
    if ($text === '/check') {
        $sendMessage->checkHandler($chat_id);
        return;
    }
    
    if ($text === '/uncheck') {
        $sendMessage->uncheckHandler($chat_id);
        return;

    }

    if ($text === '/truncate') {
        $note->truncateTasks($chat_id);
    }
    
    if ($text === '/delete') {
        $sendMessage->deleteHandler($chat_id);   
        return;     
    }
    
    if ($text === '/get') {
        $target = $note->getAllTasks($chat_id);
        $sendMessage->getHandler($target, $chat_id);
        return;
    }
}

if (isset($text)) {

    $task = $note->sendStatus($chat_id);

    if ($task == 'add') {
        $note->addTask($text, $chat_id);
        $note->deleteStatus($chat_id);
        return;
    }

    if ($task == 'check') {
        $note->checkedTaskId((int)$text - 1, 1);
        $note->deleteStatus($chat_id);
        return;
    }

    if ($task == 'uncheck') {
        $note->checkedTaskId((int)$text - 1, 0);
        $note->deleteStatus($chat_id);
        return;
    }

}

include "view.php";
?>