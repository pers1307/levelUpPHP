<?php

class Controller
{
    private $applicationHelper;

    private function __construct()
    {
    }

    static function run()
    {
        $instance = new Controller();
        $instance->init();
        $instance->handleRequest();
    }

    function init()
    {
        $applicationHelper = ApplicationHelper::instance();
        $applicationHelper ->init();
    }

    function handleRequest()
    {
        //
    }

}

/**
 * Class ApplicationHelper
 * Просто файл настроек в поддержку
 */
class ApplicationHelper
{
    private static $instance;
    private $config = 'путь к файлу настроек';

    private function __construct()
    {
    }

    static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function init()
    {
        //$dsn = ApplicationRegistry::getDSN();

//        if (!is_null($dsn)) {
//            return;
//        }

        $this->getOptions();
    }

    private function getOptions()
    {

    }

    private function ensure($expr, $message)
    {

    }
}

class Request
{
    // Класс используется для взаимодействия с глобальными переменными $_POST, $_GET
    // $_REQUEST
}

// Так запускается все приложение
Controller::run();