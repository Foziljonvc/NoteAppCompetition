<?php

declare(strict_types=1);

class DB 
{
    protected  PDO $pdo;
    
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=NoteAppCompetition", "foziljonvc", "1220");
    }
}