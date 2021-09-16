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

    public function __construct($session_id = null, $good_id = null)
    {
        $this->session_id = $session_id;
        $this->good_id = $good_id;
    }

    public static function getBasket($session_id)
    {
        $tableName = static ::getTableName();
        $sql = "SELECT basket.id basket_id, goods.id good_id, goods.title, goods.description,
        goods.price, goods.photo FROM `{$tableName}`, `goods` WHERE `session_id` = '{$session_id}' AND basket.good_id = goods.id";
        return Db::getInstanсe()->queryAll($sql);
    }

    public static function getTableName()
    {
        return 'basket';
    }
}