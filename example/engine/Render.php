<?php

namespace app\engine;

use app\interfaces\IRenderer;

class Render implements IRenderer
{

    public function renderTemplate($template, $params = [])
    {
        ob_start();  //стартует буфер, все последующие include, echo не будут выводиться на стр, а будут запоминаться
        extract($params);   //извлекаем переменные из массива
        $templatePath = VIEWS_DIR . $template . ".php";
        if (file_exists($templatePath)) {
            include_once $templatePath;
        }
        return ob_get_clean(); //очищаем буфер и возвращаем его текст (т.е.шаблона)
    }
}