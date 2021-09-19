<?php


namespace app\controllers;


use app\models\Basket;

class BasketController extends Controller
{
    public function actionBasket()
    {
//        $session_id = ;

        $basket = Basket::getBasket(session_id());
//        var_dump($session_id);
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
//    public function actionDelete() {
//        $id_good = (int)$_POST['id_good'];
//        $session_id = session_id();
////        var_dump($id_good, $session_id);
//        (new Basket($session_id,$id_good))->delete();
//        header("Location:" . $_SERVER['HTTP_REFERER']);
//        die();
//    }

}