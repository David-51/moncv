<?php
namespace App\Model\Manager;

use App\Assets\Logger;

class Database
{
    private static $pdo = null;
    
    private static function connect() :\PDO
    {
        if(!(self::$pdo)){                        
            try{
                self::$pdo = new \PDO($_ENV['BDD_DSN'], $_ENV['BDD_USERNAME'], $_ENV['BDD_PASSWORD']);                                               
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            catch(\PDOException $e){
                http_response_code(404);
                echo json_encode(['message' => 'database error']);
                Logger::setMessage($e->getMessage());
                die;
            }
            return self::$pdo;
        }
        else {                        
            return self::$pdo;
        }
    }

    public static function getConnection() :\PDO
    {
        return self::connect();
    }
}
