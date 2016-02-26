<?php

namespace woo\mapper;

abstract class Mapper
{
    protected static $PDO;

    function __construct()
    {
        if (!isset(self::$PDO)) {
            $dsn = '';
        }
    }
}