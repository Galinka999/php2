<?php


namespace app\models;


class News extends DbModel
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