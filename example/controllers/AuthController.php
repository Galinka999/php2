<?php


namespace app\controllers;

use app\engine\Session;
use app\models\User;
use app\engine\Request;

class AuthController extends Controller
{
    public function actionLogin() {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];
        //User::auth($login,$pass);
        if (User::auth($login,$pass)) {
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