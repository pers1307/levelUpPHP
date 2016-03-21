<?php

namespace woo\controller;

use woo\base\RequestRegistry;

class Request
{
    private $properties;

    // Для обмена сообщений от контроллеров пользователю
    private $feedback = [];

    function __construct()
    {
        $this->init();
        RequestRegistry::setRequest($this);
    }

    function init()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->properties = $_REQUEST;
            return;
        }

        foreach ($_SERVER['argv'] as $arg) {

            if (strpos($arg, '=')) {
                list($key, $val) = explode('=', $arg);
                $this->setProperty($key, $val);
            }
        }
    }

    function getProperty($key)
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }
    }

    // Перекладка параметров из HTTP запроса
    function setProperty($key, $val)
    {
        $this->properties[$key] = $val;
    }

    function addFeedback($msg)
    {
        array_push($this->feedback, $msg);
    }

    function getFeedback()
    {
        return $this->feedback;
    }

    function getFeedbackString($separator = '\n')
    {
        return implode($separator, $this->feedback);
    }
}