<?php

namespace core\db;

use PDO;
use PDOException;

/**
 * Class dbh Database Handler
 */
class dbh{
    private static $pdo = null;

    public static function connect(){
        if (self::$pdo !== null){
            return self::$pdo;
        }

        try {
            $dsn    = sprintf('mysql:host=%s;dbname=%s;charset=%s;port=%s', DB_HOST, DB_NAME, DB_CHARSET, DB_PORT);
            $option = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

            return self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $option);
        } catch (PDOException $e){
            exit($e->getMessage());
        }
    }
}