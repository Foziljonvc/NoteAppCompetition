<?php

declare(strict_types=1);

class User
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=NoteAppCompetition", "foziljonvc", "1220");
    }

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