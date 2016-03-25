<?php

namespace woo\controller;

use woo\base\RequestRegistry;

abstract class PageController
{
    private $request;

    function __construct()
    {
        $request = RequestRegistry::getRequest();

        if (is_null($request)) {
            $request = new Request();
        }

        $this->request = $request;
    }

    abstract function process();

    function forward($resource)
    {
        include($resource);
        exit(0);
    }

    function getRequest()
    {
        return $this->request;
    }
}