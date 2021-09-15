<?php


namespace app\controllers;

use app\models\User;

class AuthController extends Controller
{
    public function actionLogin() {
        // action ="/auth/login"
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        User::auth($login,$pass);
        if (User::auth($login,$pass)) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            die("Неверный логин или пароль");
        }
    }

    public function actionLogout() {
        session_destroy();
        header("Location:" . $_SERVER['HTTP_REFERER']);
        die();
    }

}