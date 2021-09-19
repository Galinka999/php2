<?php


namespace app\controllers;


use app\models\Good;

class GoodController extends Controller
{

    public function actionCatalog()
    {
        $page = $_GET['page'] ?: 1;
        $count = ceil(Good::getCount() / GOOD_PER_PAGE); // количество страниц
        $start = 0;
        $limit = $page * GOOD_PER_PAGE;
        $catalog = Good::getLimit($start, $limit);
        echo $this->render('catalog', [
            'catalog'=> $catalog,
            'page' => $page,
            'count' => $count,
        ]);
    }

    public function actionAjax()
    {
        $page = (int)$_GET['page'];
        $limit = $page * GOOD_PER_PAGE;
        $start = 0;
        $response = [
            'success' => 'ok',
            'page' => $page,
            'catalog' => Good::getLimit($start, $limit)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionCard()
    {
        $id = (int)$_GET['id'];
        $good = Good::getOne($id);
        echo $this->render('card',[
            'good' => $good
        ]);
    }

}