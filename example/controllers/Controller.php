<?php


namespace app\controllers;


abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $defailtLayuot = 'main';
    private $useLayuot = true;

    public function runAction($action = null)
    {
        $this->action = $action ?? $this->defaultAction;  //если не существует, то defaultAction
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method))
        {
            $this->$method();
        }
    }

    public function render($template, $params = [])
    {
        if ($this->useLayuot)
        {
            return $this->renderTemplate("layouts/{$this->defailtLayuot}", [
                'menu' => $this->renderTemplate('menu', $params),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

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