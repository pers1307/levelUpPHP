<?php
/**
 * Реализация паттерна Data Mapper
 * Наделение класса большими полномочиями
 */

namespace woo\mapper;

use woo\base\AppException;
use woo\base\ApplicationRegistry;
use woo\domain\DomainObject;

abstract class Mapper
{
    protected static $PDO;

    function __construct()
    {
        if (!isset(self::$PDO)) {
            $dsn = ApplicationRegistry::getDSN();

            if (is_null($dsn)) {
                throw new AppException('DSN не определен');
            }

            self::$PDO = new \PDO($dsn);
            self::$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    function find($id)
    {
        $this->selectStmt()->execute([$id]);
        $array = $this->selectStmt()->fetch();
        $this->selectStmt()->closeCursor();

        if (!is_array($array)) {
            return null;
        }

        if (!isset($array['id'])) {
            return null;
        }

        $object = $this->createObject($array);

        return $object;
    }

    function createObject($array)
    {
        $obj = $this->doCreateObject($array);

        return $obj;
    }

    function insert(DomainObject $obj)
    {
        $this->doInsert($obj);
    }

    abstract function update(DomainObject $object);
    protected abstract function doCreateObject(array $array);
    protected abstract function doInsert(DomainObject $object);
    protected abstract function selectStmt();
}