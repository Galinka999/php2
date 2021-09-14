<?php

namespace app\models; //клфсс Product оказался в какой-либо неизвестной папке my_shop


use app\engine\Db;

class Good extends DbModel
{
    protected $id = null;
    protected $title;
    protected $description;
    protected $price;
    protected $photo;


    //вводим массив, чтоб сравнивать изменилось ли поле
    protected $props = [
        'title' => false,
        'description' => false,
        'price' => false,
        'photo' => false
    ];

    public function __construct($title = null, $description = null, $price = null, $photo = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->photo = $photo;
    }

    public static function getTableName()
    {
        return 'goods';
    }

    public static function getCount()
    {
        $tableName = static ::getTableName();
        $sql = "SELECT COUNT(`id`) FROM {$tableName}";
        $total = Db::getInstanсe()->query($sql)->fetch(\PDO::FETCH_COLUMN);
        return $total;
    }
}

