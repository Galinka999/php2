<?php

namespace app\models;

use app\engine\Db;

class Basket extends DbModel
{
    protected $id = null;
    protected $session_id;
    protected $good_id;

    protected $props =[
        'session_id' => false,
        'good_id' => false
    ];

    public static function getBasket()
    {
        //TODO передать сессию
        $tableName = static ::getTableName();
        $sql = "SELECT basket.id basket_id, goods.id good_id, goods.title, goods.description,
        goods.price FROM `{$tableName}`, `goods` WHERE `session_id` = '111' AND basket.good_id = goods.id";
        return Db::getInstanсe()->queryAll($sql);
    }

    public static function getTableName()
    {
        return 'basket';
    }
}