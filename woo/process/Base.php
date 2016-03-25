<?php

namespace woo\process;

use woo\base\AppException;
use woo\base\ApplicationRegistry;

abstract class Base
{
    static $DB;
    static $stmts = [];

    function __construct()
    {
        $dsn = ApplicationRegistry::getDSN();

        if (is_null($dsn)) {
            throw new AppException('DSN не задан');
        }

        self::$DB = new \PDO($dsn);
        self::$DB->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    function prepareStatement($stmt_s) {
        if (isset(self::$stmts[$stmt_s])) {
            return self::$stmts[$stmt_s];
        }

        $stmt_handle = self::$DB->prepare($stmt_s);
        self::$stmts[$stmt_s] = $stmt_handle;

        return $stmt_handle;
    }

    protected function doStatement($stmt_s, $values_a)
    {
        $sth = $this->prepareStatement($stmt_s);
        $sth->closeCursor();
        $db_result = $sth->execute($values_a);

        return $sth;
    }
}