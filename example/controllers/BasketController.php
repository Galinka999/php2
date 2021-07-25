<?php


namespace app\controllers;


use app\models\Basket;

class BasketController extends Controller
{
    public function actionBasket()
    {
        $basket = Basket::getBasket();
//        var_dump($basket);
        echo $this->render('basket', [
            'basket'=> $basket
        ]);
    }
}