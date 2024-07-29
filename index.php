<?php

require "vendor/autoload.php";

$update = json_decode(file_get_contents('php://input'));
$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$sendMessage = new sendMessage();
$note = new Note();
$routes = new Routes();
$inspection = new inspection();

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

if ($inspection->isApiCall($path)) {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if ($inspection->isApiCall($path)) {

            if($inspection->isTasksCall($path)) {
        
                if ((int)$inspection->getLastOne($path)) {
            
                    echo json_encode($routes->returnIdTask((int)$inspection->getLastOne($path) - 1));
                    return;

                } else {
            
                    echo json_encode($routes->returnTasks());
                    return;
                }
        
            } else {
                echo "Enter the tasks";
                return;
            }
        } else {
            echo "Enter the api request";
            return;
        }

        return;

    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if ($inspection->isApiCall($path)) {

            if($inspection->isTasksCall($path)) {
        
                if($inspection->getLastOne($path)) {

                    $routes->saveTask($inspection->getLastOne($path));
                    echo "Task added successfully";
                    return;

                } else {

                    echo "Enter the tasks or text you want to save";
                    return;
                }

            } else {
                echo "Enter the tasks";
                return;
            }
        } else {
            echo "Enter the api request";
            return;
        }

        return;

    } elseif ($_SERVER['REQUEST_METHOD'] == 'PATCH') {

        if ($inspection->isApiCall($path)) {

            if($inspection->isTasksCall($path)) {

                if($inspection->getBeforeTheLast($path) == 'check') {

                    if($inspection->getLastOne($path)) {

                        $routes->checkedTaskId((int)$inspection->getLastOne($path) - 1, 1);
                        echo "Task checked successfully";

                    } else {
                        echo "Enter the id";
                    }

                } elseif($inspection->getBeforeTheLast($path) == 'uncheck') {

                    if($inspection->getLastOne($path)) {

                        $routes->checkedTaskId((int)$inspection->getLastOne($path) - 1, 0);
                        echo "Task unchecked successfully";

                    } else {
                        echo "Enter the id";
                        return;
                    }
                } else {
                    echo "Enter the check or uncheck";
                    return;
                }
            } else {
                echo "Enter the tasks";
                return;
            }
        } else {
            echo "Enter the api request";
            return;
        }

        return;

    } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

        if ($inspection->isApiCall($path)) {

            if($inspection->isTasksCall($path)) {

                if($inspection->getBeforeTheLast($path)) {

                    if($inspection->getLastOne($path)) {

                        $routes->deleteTasksId((int)$inspection->getLastOne($path) - 1);
                        echo "Task deleted successfully";
                        return;

                    } else {

                        echo "Enter the id";
                        return;
                    }
                } else {
                    echo "Enter the delete query";
                    return;
                }


            } else {
                echo "Enter the tasks";
                return;
            }
        } else {
            echo "Enter the api request";
            return;
        }

        return;
    }
}

include "view.php";
?>
