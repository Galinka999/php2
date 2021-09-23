<?php


namespace app\controllers;


use app\models\Basket;

class BasketController extends Controller
{
    public function actionBasket()
    {
        $basket = Basket::getBasket(session_id());
        echo $this->render('basket', [
            'basket'=> $basket
        ]);
    }

    public function actionAdd() {
        $id_good = (int)$_GET['id_good'];
        $session_id = session_id();
        (new Basket($session_id,$id_good))->save();

        $response = [
            'success' => 'ok',
            'count' => Basket::getCountWhere('session_id', session_id())
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete() {
        $basket_id = (int)$_GET['basket_id'];
        $session_id = session_id();
        $basket = Basket::getOne($basket_id);
        $error = 'ok';

        if ($session_id == $basket->session_id) {
            $basket->delete();
        }

        if (empty($basket)) {
            $error = 'non';
//            header("Location:" . $_SERVER["HTTP_REFERER"]);
        }

        $response = [
            'success' => $error,
            'count' => Basket::getCountWhere('session_id', session_id())
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

}