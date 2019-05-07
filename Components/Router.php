<?php

namespace Components;

use Controllers\BaseController;

class Router
{
    /**
     * @var array
     */
    public $routes;

    /**
     * @var string
     */
    private $rootPath;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->rootPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR;

        $param = explode('?', $_SERVER['REQUEST_URI']);
        $this->routes = explode('/', $param[0]);

        if (!$this->routes[1] || !$this->routes[2]) {
            $this->routes[1] = 'album';
            $this->routes[2] = 'index';
        }

    }

    /**
     * Trying find and call method, by controller name and action name
     * Controller should be in root/controllers and named like NameController
     * Action should be named actionIndex
     */
    public function callRequestedUrl()
    {
        $controllerClassName = $this->routes[1];

        $actionName = $this->routes[2];

        $controllerClassName[0] = strtoupper($controllerClassName[0]);
        $controllerClassNamespace = 'Controllers\\' . $controllerClassName . 'Controller';
        $controllerClassName = 'Controllers' . DIRECTORY_SEPARATOR . $controllerClassName . 'Controller';

        $controllerFileName = $this->rootPath . $controllerClassName . '.php';
        if (file_exists($controllerFileName)) {
            require $controllerFileName;

            if (class_exists($controllerClassNamespace)) {
                if (method_exists($controllerClassNamespace, 'action' . $actionName)) {
                    (new BaseController())::callAction($controllerClassNamespace, $actionName);
                } else {
                    header("HTTP/1.0 404 Method not Found");
                }
            } else {
                header("HTTP/1.0 404 Controller not Found");
            }
        } else {
            header("HTTP/1.0 404 Controller not Found");
        }
    }
}
