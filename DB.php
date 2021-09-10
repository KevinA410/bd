<?php
class DB
{
    private static $connection = NULL;

    private function __construct()
    {
    }

    public static function connect()
    {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$connection = new PDO("mysql:host=localhost;dbname=chat", 'root', 'Arias0410!', $pdo_options);

        return self::$connection;
    }
}
