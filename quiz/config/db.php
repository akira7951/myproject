<?php
namespace connection;

use PDO;
use PDOException;

class Database
{
    static function getConnection()
    {
        $servername = 'Your server name';
        $username = 'Your user name';
        $password = 'Your password';
        $database = 'Your DB';

        try{
            $pdo = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e){
            echo 'Connection failed: '.$e->getMessage();
        }
    }
}