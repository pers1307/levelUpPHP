<?php

namespace woo\controller;

use woo\base\AppException;
use woo\base\ApplicationRegistry;
use woo\command\Command;

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

        $map = new ControllerMap();

        foreach ($options->control->view as $default_view) {
            $stat_str = trim($default_view['status']);
            $status = Command::statues($stat_str);
            $map->addView('default', $status, (string)$default_view);
        }

        // анализ остальных кодов

        ApplicationRegistry::setControllerMap($map);
    }

    private function ensure($expr, $message)
    {
        if (!$expr) {
            throw new AppException($message );
        }
    }
}