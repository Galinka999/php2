<?php


namespace app\models;


use app\engine\Db;
use app\interfaces\IModels;

abstract class Model implements IModels
{

    protected $props = [];

    public function __set($name, $value)
    {
        //TODO Проверить по propes можно ли вообще менять это поле
        $this->props['name'] = true;
        $this->$name = $value;
    }

    public function __get($name)
    {
        //TODO Проверить по propes можно ли вообще читать это поле
        return $this->$name;
    }

    public function __isset($name)
    {
        //TODO Проверить существует ли поле и вернуть bool
        return true;
    }

}