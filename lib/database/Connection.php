<?php

class Connection
{
    private static $connection; 
    public static function getConnection()
    {
        if (!isset(self::$connection)) {
            $connect = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            try{
                self::$connection = new PDO($connect,DB_USER,DB_PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                self::$connection = 'Error de conexion';
                echo "Error:" . $e->getMessage();
            }
        }
        return self::$connection;
    }

}