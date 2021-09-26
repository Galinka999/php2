<?php


namespace app\controllers;


use app\engine\Request;
use app\models\entities\Good;
use app\models\repositories\GoodRepository;

class GoodController extends Controller
{

    public function actionCatalog()
    {
        $page = (new Request())->getParams()['page'] ?? 1;
        $count = ceil((new GoodRepository())->getCount() / GOOD_PER_PAGE); // количество страниц
        $start = 0;
        $limit = $page * GOOD_PER_PAGE;
        $catalog = (new GoodRepository())->getLimit($start, $limit);
        echo $this->render('catalog', [
            'catalog'=> $catalog,
            'page' => $page,
            'count' => $count,
        ]);
    }

    public function actionAjax()
    {
        $page = (int)(new Request())->getParams()['page'];
        $limit = $page * GOOD_PER_PAGE;
        $start = 0;
        $response = [
            'success' => 'ok',
            'page' => $page,
            'catalog' => (new GoodRepository())->getLimit($start, $limit)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function actionCard()
    {
        $id = (int)(new Request())->getParams()['id'];
        $good = (new GoodRepository())->getOne($id);
        echo $this->render('card',[
            'good' => $good
        ]);
    }

}