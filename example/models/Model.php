<?php


namespace app\models;


use app\engine\Db;
use app\interfaces\IModels;

abstract class Model implements IModels
{

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

}