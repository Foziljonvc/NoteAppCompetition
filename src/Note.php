<?php

declare(strict_types=1);

class Note extends DB {

    public function addNotes (string $text)
    {
        $stmt = $this->pdo->prepare("INSERT INTO Notes (notes, data, status) VALUES (:notes, :data, :status)");
        $now = date('Y:m:d H-i-s');
        $status = 0;
        $stmt->bindParam(':notes', $text);
        $stmt->bindParam(':data', $now);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }
    
    public function addTask (string $text, int $chatId)
    {
        $query = "INSERT INTO Notes (userId, notes, data, status) VALUES (:userId, :notes, :data, :status)";
        $status = '0';
        $now = date('Y:m:d H-i-s');
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $chatId);
        $stmt->bindParam(':notes', $text);
        $stmt->bindParam(':data', $now);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
    }


    public function getAllNotes ()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Notes");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteNote(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Notes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateNote(string $text, int $id)
    {
        $stmt = $this->pdo->prepare("UPDATE Notes SET notes = :notes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':notes', $text);
        $stmt->execute();
    }

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

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function truncateTasks (int $chatId) 
    {
        $stmt = $this->pdo->prepare("DELETE FROM Notes WHERE userId = :userId");
        $stmt->bindParam(':userId', $chatId);
        $stmt->execute();
    }

}