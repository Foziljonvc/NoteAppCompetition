<?php
class USER{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function add(string $text, int $userId): bool
    {
 
        

    
        $stmt   = $this->pdo->prepare("INSERT INTO NoteApp (notes) VALUES (:notes)");
        $stmt->bindParam(':notes', $notes);
        
        return $stmt->execute();
    }
}