<?php

namespace app\engine;

class Autoload
{

    function loadClass($className)
    {
        $fileName = str_replace(['app', '\\'], [ROOT_DIR, DS] , $className) . ".php";

        if(file_exists($fileName))
        {
            require_once $fileName;
        }
    }
}