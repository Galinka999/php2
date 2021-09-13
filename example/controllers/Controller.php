<?php


namespace app\controllers;


use app\engine\Render;
use app\interfaces\IRenderer;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $defailtLayuot = 'main';
    private $useLayuot = true;

    private $renderer;

    /**
     * Controller constructor.
     */
    public function __construct(IRenderer $render)
    {
        $this->renderer = $render;
    }


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
        return $this->renderer->renderTemplate($template, $params);
    }
}