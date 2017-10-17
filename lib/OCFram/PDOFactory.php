<?php
namespace OCFram;

class PDOFactory
{
    public static function getMysqlConnexion()
    {
        $db = new \PDO('mysql:host=localhost;dbname=news', 'root', 'password');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}