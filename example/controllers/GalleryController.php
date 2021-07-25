<?php


namespace app\controllers;

use app\models\Gallery;

class GalleryController extends Controller
{
    public function actionGallery()
    {
        $gallery = Gallery::getGallery();
//        var_dump($gallery);
        echo $this->render('gallery', [
            'gallery'=> $gallery
        ]);
    }
    public function actionGalleryOne()
    {

    }
}