<?php

namespace app\engine;

class Autoload
{
//    private $path = [  //до namespace было так
//        'models',
//        'engine',
//        'interfaces'
//    ];

    function loadClass($className)
    {
//        var_dump($className);
        $fileName = str_replace(['app', '\\'], [ROOT_DIR, DS] , $className) . ".php";
//        var_dump($className);
//        foreach ($this->path as $path)
//        {
//            if (isset($className))
//            {
//                $fileName = "../{$path}/{$className}.php";
//                //var_dump($fileName);
//                if (file_exists($fileName)) //проверили на существование
//                    include_once $fileName;
//            }
//        }
        if(file_exists($fileName))
        {
            require_once $fileName;
        }
    }
}