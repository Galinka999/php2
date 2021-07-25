<?php


namespace app\models;


class News extends DbModel
{
    public $id = null;
    public $title;
    public $text;
    public $photo;
    public $likes;


    public static function getTableName()
    {
        return 'news';
    }
}