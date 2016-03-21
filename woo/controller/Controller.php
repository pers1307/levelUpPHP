<?php

namespace woo\controller;

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
        $cmd_r = new CommandResolver();
        $cmd = $cmd_r->getCommand($request);
        $cmd->execute($request);
    }
}