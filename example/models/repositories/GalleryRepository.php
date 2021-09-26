<?php


namespace app\models\repositories;

use app\models\entities\Gallery;
use app\models\Repository;

class GalleryRepository extends Repository
{

    protected function getTableName()
    {
        return 'images';
    }

    protected function getEntityClass()
    {
        return Gallery::class;
    }
}