<?php

namespace app\models;

use app\engine\Db;

class Basket extends DbModel
{
    public $id = null;
    public $session_id;
    public $good_id;

    public static function getBasket()
    {
        $tableName = static ::getTableName();
        $sql = "SELECT * FROM {$tableName}";
//        var_dump(Db::getInstanсe()->queryAll($sql, $params = null));
        return Db::getInstanсe()->queryAll($sql, $params = null);
    }

    public static function getTableName()
    {
        return 'basket';
    }
}