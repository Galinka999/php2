<?php


namespace app\models\repositories;


use app\models\entities\Good;
use app\models\Repository;

class GoodRepository extends Repository
{

    protected function getTableName()
    {
        return 'goods';
    }

    protected function getEntityClass()
    {
        return Good::class;
    }
}