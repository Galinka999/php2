<?php


namespace app\models;


class Order extends DbModel
{
    public $id = null;
    public $name;
    public $phone;
    public $session_id;
    public $status;


    public static function getTableName()
    {
        return 'orders';
    }
}