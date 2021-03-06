<?php


namespace app\controllers;


use app\interfaces\IRenderer;
use app\models\repositories\BasketRepository;
use app\models\repositories\UserRepository;


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
                'menu' => $this->renderTemplate('menu', [
                    'isAuth' => (new UserRepository())->isAuth(),
                    'userName' => (new UserRepository())->getName(),
                    'count_goods' => (new BasketRepository())->getCountWhere('session_id', session_id())
                ]),
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