<?php

class Db
{
    public static function getConnection()
    {
        $paramsPath=ROOT.'/config/db_params.php';
        $params=include($paramsPath);
        
        $dsn="mysql:host={$params['host']};dbname={$params['dbname']}";
        $db= new PDO($dsn, $params['user'], $params['password']);
        $db->exec("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
        $db->exec("SET CHARACTER SET 'utf8'");        
        return $db;
    }

    public static function getConnectionFront()
    {
        $paramsPath=ROOT.'/config/db_params.php';
        $params=include($paramsPath);
        
        $dsn="mysql:host={$params['host']};dbname={$params['dbname_front']}";
        $db= new PDO($dsn, $params['user_front'], $params['password_front']);
        $db->exec("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
        $db->exec("SET CHARACTER SET 'utf8'");
        return $db;
    }
}