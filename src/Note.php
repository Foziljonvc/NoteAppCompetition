<?php

declare(strict_types=1);

class User extends DB
{

    public function addNotes (string $text)
    {
        $stmt = $this->pdo->prepare("INSERT INTO NoteApp (notes) VALUES (:notes)");
        $stmt->bindParam(':notes', $text);
        $stmt->execute();
    }

    public function getAllNotes ()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM NoteApp");
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}