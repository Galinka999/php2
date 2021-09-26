<?php


namespace app\controllers;

use app\engine\Session;
use app\models\entities\User;
use app\engine\Request;
use app\models\repositories\UserRepository;

class AuthController extends Controller
{
    public function actionLogin() {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];
        //User::auth($login,$pass);
        if ((new UserRepository())->auth($login,$pass)) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            die("Неверный логин или пароль");
        }
    }

    public function actionLogout() {
        $session = new Session();
        $session->destroy();
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die();
    }

}