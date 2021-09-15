<?php

namespace app\models;


class User extends DbModel
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

    public static function auth($login, $pass) {

        $user = User::getWhere('login', $login);

        if (password_verify($pass, $user->pass)) {
            $_SESSION['auth']['login'] = $login;
            $_SESSION['auth']['id'] = $user->id;
            return true;
        } else {
            return false;
        }
    }

    public static function isAuth() {
        return isset($_SESSION['auth']['login']); //если существует значит кто-то авторизован
    }

    public static function getName() {
        return $_SESSION['auth']['login'];
    }

//    public static function reg($login, $pass, $email) {
//    }
//
//    public static function isReg($login, $email) {
//        $user_login = User::getWhere('login', $login);
//        $user_email = User::getWhere('email', $email);
//        if ($user_login || $user_email) {
//            return true;
//        } else {
//            return false;
//        }
//    }

    public static function getTableName()
    {
        return 'users';
    }

}