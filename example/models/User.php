<?php

namespace app\models;


class User extends DbModel
{
    protected $id = null;
    protected $login;
    protected $pass;

    protected $props = [
        'login' => false,
        'pass' => false
    ];

    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;

    }

    public static function getTableName()
    {
        return 'users';
    }



}