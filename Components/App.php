<?php

namespace Components;

class App
{
    /**
     * @var App
     */
    private static $_app;

    /**
     * @var array
     */
    public $config;

    /**
     * @var Router
     */
    public $router;

    /**
     * @var DB
     */
    public $db;

    /**
     * @var array
     */
    public $params = [];

    public function run()
    {
        session_start();
        if (self::$_app !== null) {
            return;
        }

        self::$_app = $this;

        self::$_app->initConfig();
        self::$_app->init();

        self::$_app->router->callRequestedUrl();
    }

    /**
     * @return App
     */
    public static function app()
    {
        return self::$_app;
    }

    private function initConfig()
    {
        self::$_app->config = require ROOT_PATH . '/config.php';
    }

    private function init()
    {
        $this->router = new Router();

        $this->db =  new DB(
            self::$_app->config['db']['host'],
            self::$_app->config['db']['login'],
            self::$_app->config['db']['password'],
            self::$_app->config['db']['database'],
            self::$_app->config['db']['port']
        );

    }

}