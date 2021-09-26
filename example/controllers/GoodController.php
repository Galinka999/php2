<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Good;

class GoodController extends Controller
{

    public function actionCatalog()
    {
        $page = new Request();
        $page = $page->getParams()['page'] + 1;
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
        $page = new Request();
        $page = $page->getParams()['page'];
        $limit = $page * GOOD_PER_PAGE;
        $start = 0;
        $response = [
            'success' => 'ok',
            'page' => $page,
            'catalog' => Good::getLimit($start, $limit)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function actionCard()
    {
        $id = new Request();
        $id = $id->getParams()['id'];
        $good = Good::getOne($id);
        echo $this->render('card',[
            'good' => $good
        ]);
    }

}