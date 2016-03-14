<?php

/**
 * Class Registry
 * Смысл паттерна в кот, что это глобальные переменные обернутые в siglaeton
 */
abstract class Registry
{
    abstract protected function get($key);
    abstract protected function set($key, $val);
}

class RequestRegistry extends Registry
{
    private $values = [];
    private static $instance;

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

    function get($key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }

        return null;
    }

    function set($key, $value)
    {
        $this->values[$key] = $value;
    }
}


//class Registry
//{
//    private static $instance;
//    private $values = [];
//
//    private function __construct()
//    {
//
//    }
//
//    static function instance()
//    {
//        if (!isset(self::$instance)) {
//            self::$instance = new self();
//        }
//
//        return self::$instance;
//    }
//
//    function get($key)
//    {
//        if (isset($this->values[$key])) {
//            return $this->values[$key];
//        }
//
//        return null;
//    }
//
//    function set($key, $value)
//    {
//        $this->values[$key] = $value;
//    }
//}
//
//class Request
//{
//
//}
//
//$reg = Registry::instance();
//$reg->setRequest(new Request());
//
//$reg = Registry::instance();
//var_dump($reg->getRequest());