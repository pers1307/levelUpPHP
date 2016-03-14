<?php

namespace woo\controller;

use woo\base\AppException;

class ApplicationHelper
{
    function getOptions()
    {
        if (!file_exists('data/woo_options.xml')) {
            throw new AppException('Файл не найден');
        }

        $options = simplexml_load_file('data/woo_options.xml');
        $dsn = (string)$options->dsn;

        //...
    }
}