<?php

namespace Controllers;

use Components\App;

class BaseController
{
    protected $scripts = [];
    protected $styles = [];

    protected $viewPath;
    protected $layout = 'layouts/main';
    protected $title = 'CD';

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $controller;

    /**
     * @param $controller string
     * @param $action string
     */
    public static function callAction(string $controller, string $action)
    {
        /** @var $controllerInstance Controller */
        $controllerInstance = new $controller();
        $controllerInstance->action = App::app()->router->routes[2];
        $controllerInstance->controller = App::app()->router->routes[1];

        $realActionName = 'action' . $action;
        $controllerInstance->$realActionName();
    }

    protected function render(string $templateFile, $data = [])
    {
        ob_start();
        if (file_exists($filename = $this->viewPath . $templateFile . '.php')) {
            extract($data);
            require $filename;
        }
        $template = ob_get_clean();
        $html = $this->renderLayout($template);
        echo $html;
    }

    protected function renderLayout($content)
    {
        ob_start();
        if (file_exists($filename = $this->viewPath . $this->layout . '.php')) {
            require $filename;
        }
        return ob_get_clean();
    }

    public function __construct()
    {
        $this->viewPath = ROOT_PATH . '/Views/';
    }
}