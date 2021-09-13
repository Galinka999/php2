<?php
session_start();
// Добавлять сообщения обо всех ошибках, кроме E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

include_once "../config/Config.php";
include_once "../engine/Autoload.php";

use app\models\{Good, User, Order, News, Basket};
use app\engine\Autoload;
use app\engine\Db;
use app\engine\Render;

spl_autoload_register([new Autoload(), 'loadClass']); //регистрирует автозагрузчик

$url = explode('/', $_SERVER['REQUEST_URI']);
//var_dump($url);

$controllerName = $url[1] ?: 'index';
$actionName = $url[2];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
//var_dump($controllerClass);
if (class_exists($controllerClass))
{
    $controller = new $controllerClass(new Render());
//    var_dump($controller);
    if(isset($actionName)) {
        $controller->runAction($actionName);
    } else {
        $controller->runAction($controllerName);
//        var_dump($controller);
    }
}






die();

//паттерн ActiveRecord

//CREATE
$product = Good::getOne();
//$product->insert();
//$product->save(); //Записать в БД

//READ
$product = Good::getAll();

//DELETE
$product = Good::getOne(1);
$product->delete();

//UPDATE
$product = Good::getOne(1);
$product->name = "Сок";
$product->save();
