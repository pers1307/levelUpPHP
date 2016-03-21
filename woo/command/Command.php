<?php

namespace woo\command;

use woo\controller\Request;

abstract class Command
{
    final function __construct()
    {

    }

    function execute(Request $request)
    {
        $this->doExecute($request);
    }

    abstract function doExecute(Request $request);
}