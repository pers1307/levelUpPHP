<?php

namespace woo\controller;

use woo\base\ApplicationRegistry;
use woo\command\CommandResolver;

class Controller
{
    private $applicationHelper;

    private function __construct()
    {
    }

    static function run()
    {
        $instanse = new Controller();
        $instanse->init();
        $instanse->handleRequest();
    }

    function init()
    {
        // В классе ApplicationHelper хранятся настройки для всего приложения
        $applicationHelper = ApplicationHelper::instance();
        $applicationHelper->init();
    }

    function handleRequest()
    {
        $request = new Request();

        $app_c = ApplicationRegistry::appController();

        while ($cmd = $app_c->getCommand($request)) {
            print 'Выполняется ' . get_class($cmd) . '\n';
            $cmd->execute($request);
        }

        $this->invokeView($app_c->getView());

//        $cmd_r = new CommandResolver();
//        $cmd = $cmd_r->getCommand($request);
//        $cmd->execute($request);
    }

    function invokeView($target)
    {
        include 'woo/view/' . $target . '.php';
        exit;
    }
}