<?php

declare(strict_types=1);

class User extends DB
{

    public function addNotes (string $text)
    {
        $stmt = $this->pdo->prepare("INSERT INTO NoteApp (notes, data) VALUES (:notes, :data)");
        $now = date('Y:m:d H-i-s');
        $stmt->bindParam(':notes', $text);
        $stmt->bindParam(':data', $now);
        $stmt->execute();
    }

    public function getAllNotes ()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM NoteApp");
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteNote(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM NoteApp WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateNote(string $text, int $id)
    {
        $stmt = $this->pdo->prepare("UPDATE NoteApp SET notes = :notes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':notes', $text);
        $stmt->execute();
    }

}