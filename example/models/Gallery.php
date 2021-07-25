<?php

namespace app\models;

use app\engine\Db;

class Gallery extends DbModel
{
    public $id = null;
    public $filename;
    public $likes;

    public static function getGallery()
    {
        $tableName = static ::getTableName();
        $sql = "SELECT * FROM {$tableName}";
//        var_dump(Db::getInstanсe()->queryAll($sql, $params = null));
        return Db::getInstanсe()->queryAll($sql, $params = null);
    }

    public static function getTableName()
    {
        return 'images';
    }
}