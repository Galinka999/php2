<?php

namespace app\models\entities;

use app\models\Model;
use app\engine\Db;

class Gallery extends Model
{
    protected $id = null;
    protected $filename;
    protected $likes;

    protected $props = [
        'filename' => false,
        '$likes' => false
    ];

    public function __construct($filename = null, $likes = null)
    {
        $this->filename = $filename;
        $this->likes = $likes;
    }
}