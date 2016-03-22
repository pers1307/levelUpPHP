<?php

namespace woo\command;

use woo\controller\Request;

abstract class Command
{
    private static $STATUS_STRINGS = [
        'CMD_DEFAULT' => 0,
        'CMD_OK' => 1,
        'CMD_ERROR' => 2,
        'CMD_INSUFFICIENT_DATA' => 3
    ];

    private $status = 0;

    final function __construct()
    {

    }

    function execute(Request $request)
    {
        $this->status = $this->doExecute($request);
        $request->setCommand($this);
    }

    function getStatus()
    {
        return $this->status;
    }

    static function statuses($str = 'CMD_DEFAULT')
    {
        if (empty($str)) {
            $str = 'CMD_DEFAULT';
        }

        return self::$STATUS_STRINGS[$str];
    }

    abstract function doExecute(Request $request);
}