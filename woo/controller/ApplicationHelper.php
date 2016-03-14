<?php

namespace woo\controller;

use woo\base\AppException;

class ApplicationHelper
{
    private static $instance;
    private $config = '/tmp/data/woo_options.xml';

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

    function getOptions()
    {
        if (!file_exists('data/woo_options.xml')) {
            throw new AppException('Файл не найден');
        }

        $options = simplexml_load_file('data/woo_options.xml');
        $dsn = (string)$options->dsn;

        //...
    }

    private function ensure($expr, $message)
    {

    }
}