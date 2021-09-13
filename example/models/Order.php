<?php


namespace app\models;


class Order extends DbModel
{
    protected $id = null;
    protected $name;
    protected $phone;
    protected $session_id;
    protected $status;

    protected $props = [
        'name' => false,
        'phone' => false,
        'session_id' => false,
        'status' => false
    ];


    public static function getTableName()
    {
        return 'orders';
    }
}