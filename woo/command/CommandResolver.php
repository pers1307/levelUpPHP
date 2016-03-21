<?php

namespace woo\command;

use woo\controller\Request;

class CommandResolver
{
    private static $base_cmd;
    private static $default_cmd;

    function __construct()
    {
        if (!self::$base_cmd) {
            self::$base_cmd    = new \ReflectionClass('\woo\command\Command');
            self::$default_cmd = new DefaultCommand();
        }
    }

    function getCommand(Request $request)
    {
        $cmd = $request->getProperty('cmd');
        $sep = DIRECTORY_SEPARATOR;

        if (!$cmd) {
            return self::$default_cmd;
        }

        $cmd = str_replace(['.', $sep], '', $cmd);
        $filepath = 'woo' . $sep . 'command' . $sep . $cmd . '.php';
        $classname = 'woo\\command\\' . $cmd;

        if (file_exists($filepath)) {
            require_once $filepath;

            if (class_exists($classname)) {
                $cmd_class = new \ReflectionClass($classname);

                if ($cmd_class->isSubclassOf(self::$base_cmd)) {
                    return $cmd_class->newInstance();
                } else {
                    $request->addFeedback('Объект с указанной командой не найден');
                }
            }
        }

        $request->addFeedback('Команда ' . $cmd . 'не найдена');

        return clone self::$default_cmd;
    }
}