<?php

namespace woo\command;

use woo\controller\Request;

class DefaultCommand extends Command
{
    function doExecute(Request $request)
    {
        $request->addFeedback('Welcome in Woo? men!');
        include 'woo/view/main.php';
    }
}