<?php


namespace app\controllers;

use app\models\Gallery;

class GalleryController extends Controller
{
    public function actionGallery()
    {
        $gallery = Gallery::getAll();
//        var_dump($gallery);
        echo $this->render('gallery', [
            'gallery'=> $gallery
        ]);
    }
    public function actionGalleryOne()
    {
        $id = (int)$_GET['id'];
        $galleryOne = Gallery::getOne($id);
        echo $this->render('galleryOne',[
            'galleryOne' => $galleryOne
        ]);
    }
}