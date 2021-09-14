<?php


namespace app\controllers;


use app\models\Good;

class GoodController extends Controller
{

    public function actionCatalog()
    {
        $page = $_GET['page'] ?? 0;
        $count = ceil(Good::getCount() / GOOD_PER_PAGE); // количество страниц
        $count = $count - 1;
        $start = $page * GOOD_PER_PAGE;
        $limit = ($page + 1) * GOOD_PER_PAGE;
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
        $limit = GOOD_PER_PAGE;
        $start = $page * GOOD_PER_PAGE;
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