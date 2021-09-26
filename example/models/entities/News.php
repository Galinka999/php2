<?php


namespace app\models\entities;

use app\models\Model;

class News extends Model
{
    protected $id = null;
    protected $title;
    protected $text;
    protected $photo;
    protected $likes;

    protected $props = [
        'title' => false,
        'text' => false,
        'photo' => false,
        'likes' => false
    ];


    public static function getTableName()
    {
        return 'news';
    }
}