<?php

namespace woo\controller;

use woo\base\AppException;
use woo\command\DefaultCommand;

class AppController
{
    private static $base_cmd;
    private static $default_cmd;
    private $controllerMap;
    private $invoked = [];

    function __construct(ControllerMap $map)
    {
        $this->controllerMap = $map;

        if (!self::$base_cmd) {
            self::$base_cmd    = new \ReflectionClass('\\woo\\command\\Command');
            self::$default_cmd = new DefaultCommand();
        }
    }

    function getView(Request $req)
    {
        $view = $this->getResource($req, 'View');

        return $view;
    }

    function getForward(Request $req)
    {
        $forward = $this->getResource($req, "Forward");

        if ($forward) {
            $req->setProperty('cmd', $forward);
        }

        return $forward;
    }

    private function getResource(Request $req, $res)
    {
        // Определяем пред. команду и её код состояния
        $cmd_str = $req->getProperty('cmd');
        $previous = $req->getLastCommand();
        $status = $previous->getStatus();

        if (!$status) {
            $status = 0;
        }
        $acquire = 'get' . $res;

        $resource = $this->controllerMap->$acquire($cmd_str, $status);

        if (!$resource) {
            $resource = $this->controllerMap->$acquire($cmd_str, 0);
        }

        if (!$resource) {
            $resource = $this->controllerMap->$acquire('default', $status);
        }

        if (!$resource) {
            $resource = $this->controllerMap->$acquire('default', 0);
        }

        return $resource;
    }

    function getCommand(Request $req)
    {
        $previous = $req->getLastCommand();

        if (!$previous) {
            $cmd = $req->getProperty('cmd');

            if (!$cmd) {
                $req->setProperty('cmd', 'default');

                return self::$default_cmd;
            }

        } else {
            $cmd = $this->getForward($req);

            if (!$cmd) {
                return null;
            }

            $cmd_obj = $this->resolveCommand($cmd);

            if (!$cmd_obj) {
                throw new AppException('Команда не найдена');
            }

            $cmd_class = get_class($cmd_obj);

            if (isset($this->invoked[$cmd_class])) {
                throw new AppException('Циклический вызов');
            }

            $this->invoked[$cmd_class] = 1;

            return $cmd_obj;
        }
    }

    function resolveCommand($cmd)
    {
        $classroot = $this->controllerMap->getClassroot($cmd);
        $filePath = 'woo/command/' . $classroot . '.php';
        $classname = '\\woocommand\\' . $classroot;

        if (file_exists($filePath)) {
            require_once $filePath;

            if (class_exists($classname)) {
                $cmd_class = new \ReflectionClass($classname);

                if ($cmd_class->isSubclassOf(self::$base_cmd)) {
                    return $cmd_class->newInstance();
                }
            }
        }

        return null;
    }

}