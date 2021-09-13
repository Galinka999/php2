<?php


namespace app\controllers;


use app\models\Good;

class GoodController extends Controller
{
    public $limit = 2;

    public function actionCatalog()
    {
//        $catalog = Good::getAll();
        $page = $_GET['page'] ?? 0;
//        var_dump($page);
        $count = ceil(Good::getCount()/$this->limit); // количество страниц
        $count = $count - 1;
        $start = $page*$this->limit;
//        var_dump($start);
        $limit = ($page+1) * $this->limit;
//        var_dump($limit);
        $catalog = Good::getLimit($start, $limit);
        echo $this->render('catalog', [
            'catalog'=> $catalog,
            'page' => $page,
            'limit'=> $limit,
            'count' => $count,
        ]);
    }

    public function actionAjax()
    {
        $page = (int)$_GET['page'];
//        var_dump($page);
        $limit = $this->limit;
        $start = $page*2;
        $catalog = Good::getLimit($start, $limit);
        echo $this->renderTemplate('ajax', [
            'catalog'=> $catalog,
            'page' => $page,
        ]);
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