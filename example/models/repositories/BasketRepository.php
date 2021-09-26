<?php


namespace app\models\repositories;


use app\engine\Db;
use app\models\entities\Basket;
use app\models\Repository;

class BasketRepository extends Repository
{
    public function getBasket($session_id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT basket.id basket_id, goods.id good_id, goods.title, goods.description,
        goods.price, goods.photo FROM `{$tableName}`, `goods` WHERE `session_id` = '{$session_id}' AND basket.good_id = goods.id";
        return Db::getInstanсe()->queryAll($sql);
    }

    protected function getEntityClass()
    {
        return Basket::class;
    }

    protected function getTableName()
    {
        return 'basket';
    }
}