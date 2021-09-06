<?php

namespace app\models;

use app\engine\Db;

class Gallery extends DbModel
{
    public $id = null;
    public $filename;
    public $likes;

    public function __construct($filename = null, $likes = null)
    {
        $this->filename = $filename;
        $this->likes = $likes;
    }

    public static function getTableName()
    {
        return 'images';
    }
}