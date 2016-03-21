<?php

namespace woo\controller;

use woo\base\AppException;
use woo\base\ApplicationRegistry;

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
        $dsn = ApplicationRegistry::getDSN();

        if (!is_null($dsn)) {
            // Данные хранятся в кэше
            return;
        }

        $this->getOptions();
    }

    private function getOptions()
    {
        $this->ensure(file_exists($this->config), 'Файл конфигурации не найден');
        $options = simplexml_load_file($this->config);

        print get_class($options);
        $dsn = (string)$options->dsn;
        $this->ensure($options instanceof \SimpleXMLElement, 'Файл конфигурации запорчен');
        $this->ensure($dsn, 'DSN не найден');
        ApplicationRegistry::setDSN($dsn);
        // ...
    }

    private function ensure($expr, $message)
    {
        if (!$expr) {
            throw new AppException($message );
        }
    }
}