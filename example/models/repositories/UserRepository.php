<?php


namespace app\models\repositories;


use app\models\Repository;
use app\models\entities\User;

class UserRepository extends Repository
{

    protected function getTableName()
    {
        return 'users';
    }

    protected function getEntityClass()
    {
        return User::class;
    }

    public function auth($login, $pass) {

        $user = $this->getWhere('login', $login);

        if (password_verify($pass, $user->pass)) {
            $_SESSION['auth']['login'] = $login;
            $_SESSION['auth']['id'] = $user->id;
            return true;
        } else {
            return false;
        }
    }

    public function isAuth() {
        return isset($_SESSION['auth']['login']); //если существует значит кто-то авторизован
    }

    public function getName() {
        return $_SESSION['auth']['login'];
    }

}