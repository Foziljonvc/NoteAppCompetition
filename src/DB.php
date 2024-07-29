<?php

declare(strict_types=1);

class DB 
{
    protected  PDO $pdo;
    protected static $connect;

    public static function connect()
    {
        self::$connect = new PDO("mysql:host=localhost;dbname=NoteAppCompetition", "foziljonvc", "1220");
    }


    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=NoteAppCompetition", "foziljonvc", "1220");
    }
}