<?php


namespace app\controllers;

use app\engine\Request;
use app\models\entities\Gallery;
use app\models\repositories\GalleryRepository;

class GalleryController extends Controller
{
    public function actionGallery()
    {
        $gallery = (new GalleryRepository())->getAll();
        echo $this->render('gallery', [
            'gallery'=> $gallery
        ]);
    }
    public function actionGalleryOne()
    {
//        $id = (int)$_GET['id'];
        $id = new Request();
        $id = $id->getParams()['id'];
        $galleryOne = (new GalleryRepository())->getOne($id);
        echo $this->render('galleryOne',[
            'galleryOne' => $galleryOne
        ]);
    }
}