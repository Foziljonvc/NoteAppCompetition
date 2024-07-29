<?php

declare(strict_types=1);

class User extends DB {

    public function sendStatus (int $chatId) 
    {
        $stmt = $this->pdo->prepare("SELECT status FROM user WHERE chatId = :chatId");
        $stmt->bindParam(':chatId', $chatId, PDO::PARAM_INT);
        $stmt->execute();

        $target = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // print_r($target[0]['status']);
        return $target[0]['status'];

    }

    public function sendChatId (int $chatId)
    {
        $stmt = $this->pdo->prepare("SELECT chatId FROM user WHERE chatId = :chatId");
        $stmt->bindParam(':chatId', $chatId);
        $stmt->execute();

        $target = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $target[0]['chatId'];
    }

    public function saveUser (int $chatId) 
    {
        $status = 0;

        $stmt = $this->pdo->prepare("INSERT INTO user (chatId, status) VALUES (:chatId, :status)");
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }

    public function saveCommand (int $chatId, string $text)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET status = :status WHERE chatId = :chatId");
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':status', $text);
        $stmt->execute();
    }

    public function deleteStatus (int $chatId)
    {
        $status = 0;

        $stmt = $this->pdo->prepare("UPDATE user SET status = :status WHERE chatId = :chatId");
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }

    public function addTask (string $text, int $chatId)
    {
        $query = "INSERT INTO Notes (userId, todo, status) VALUES (:userId, :todo, :status)";
        $status = '0';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $chatId);
        $stmt->bindParam(':todo', $text);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }

    public function checkedTaskId (int $id, int $checked)
    {
        if ($checked == 1) {
            $status = 1;
        
            $stmtSub = $this->pdo->prepare("
                SELECT id 
                FROM Notes 
                ORDER BY id 
                LIMIT 1 OFFSET :offset
            ");
            $stmtSub->bindValue(':offset', $id, PDO::PARAM_INT);
            $stmtSub->execute();
            $result = $stmtSub->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                $id = $result['id'];
                
                $stmt = $this->pdo->prepare("
                    UPDATE Notes 
                    SET status = :status 
                    WHERE id = :id
                ");
                $stmt->bindValue(':status', $status, PDO::PARAM_INT);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }
        } else {
            $status = 0;
    
            $stmtSub = $this->pdo->prepare("
                SELECT id 
                FROM Notes 
                ORDER BY id 
                LIMIT 1 OFFSET :offset
            ");
            $stmtSub->bindValue(':offset', $id, PDO::PARAM_INT);
            $stmtSub->execute();
            $result = $stmtSub->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                $id = $result['id'];
                
                $stmt = $this->pdo->prepare("
                    UPDATE Notes 
                    SET status = :status 
                    WHERE id = :id
                ");
                $stmt->bindValue(':status', $status, PDO::PARAM_INT);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
    }

    public function getAllTasks(int $chatId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Notes WHERE userId = :userId");
        $stmt->bindParam(':userId', $chatId);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function truncateTasks (int $chatId) 
    {
        $stmt = $this->pdo->prepare("DELETE FROM Notes WHERE userId = :userId");
        $stmt->bindParam(':userId', $chatId);
        $stmt->execute();
    }
}

// CREATE TABLE UsersPlan (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     userId BIGINT,
//     todo VARCHAR(255),
//     status VARCHAR(32)
// );