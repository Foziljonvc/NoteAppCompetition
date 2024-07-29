<?php
class USER{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function add(string $notes): bool
    {
 
        

    
        $stmt   = $this->pdo->prepare("INSERT INTO NoteApp (notes) VALUES (:notes)");
        $stmt->bindParam(':notes', $notes);
        
        return $stmt->execute();
    }

    public function getAll(): false|array
    {
        return $this->pdo->query("SELECT * FROM NoteApp")->fetchAll(PDO::FETCH_OBJ);
    }

}