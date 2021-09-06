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
//        $sql = "SELECT basket.id basket_id, goods.id good_id FROM {$tableName}";
        $sql = "SELECT basket.id basket_id, goods.id good_id, goods.title, goods.description,
        goods.price FROM `basket`, `goods` WHERE `session_id` = '111' AND basket.good_id = goods.id";
//        var_dump($sql);
        //        var_dump(Db::getInstanсe()->queryAll($sql, $params = null));
        return Db::getInstanсe()->queryAll($sql, $params = null);
    }

    public static function getTableName()
    {
        return 'basket';
    }
}