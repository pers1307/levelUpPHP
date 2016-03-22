<?php

namespace woo\controller;

/**
 * Class ControllerMap
 * @package woo\controller
 * Класс хранит в себе закэшированные настройке
 * по сути служит оболочкой для массивов, но
 * его преимущество в том, что эти массивы будут иметь строгий формат
 */
class ControllerMap
{
    private $viewMap      = [];
    private $forwardMap   = [];
    private $classrootMap = [];

    function addClassroot($command, $classroot)
    {
        $this->classrootMap[$command] = $classroot;
    }

    function getClassroot($command)
    {
        if (isset($this->classrootMap[$command])) {
            return $this->classrootMap[$command];
        }

        return $command;
    }

    function addView($command='default', $status = 0, $view)
    {
        $this->viewMap[$command][$status] = $view;
    }

    function getView($command, $status)
    {
        if (isset($this->viewMap[$command][$status])) {
            return $this->viewMap[$command][$status];
        }

        return null;
    }

    function addForward($command, $status = 0, $newCommand)
    {
        $this->forwardMap[$command][$status] = $newCommand;
    }

    function getForward($command, $status)
    {
        if (isset($this->forwardMap[$command][$status])) {
            return $this->forwardMap[$command][$status];
        }

        return null;
    }

}