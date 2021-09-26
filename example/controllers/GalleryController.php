<?php


namespace app\controllers;

use app\engine\Request;
use app\models\Gallery;

class GalleryController extends Controller
{
    public function actionGallery()
    {
        $gallery = Gallery::getAll();
        echo $this->render('gallery', [
            'gallery'=> $gallery
        ]);
    }
    public function actionGalleryOne()
    {
//        $id = (int)$_GET['id'];
        $id = new Request();
        $id = $id->getParams()['id'];
        $galleryOne = Gallery::getOne($id);
        echo $this->render('galleryOne',[
            'galleryOne' => $galleryOne
        ]);
    }
}