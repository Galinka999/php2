<?php

namespace app\models;

use app\engine\Db;

class Gallery extends DbModel
{
    protected $id = null;
    protected $filename;
    protected $likes;

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