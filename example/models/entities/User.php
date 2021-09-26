<?php

namespace app\models\entities;


use app\models\Model;

class User extends Model
{
    protected $id = null;
    protected $login;
    protected $pass;
    protected $email;
    protected $date;
    protected $user_group;

    protected $props = [
        'login' => false,
        'pass' => false,
        '$email' => false,
        'date' => false,
        'user_group' => false
    ];

    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

}