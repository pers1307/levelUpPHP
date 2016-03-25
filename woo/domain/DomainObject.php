<?php
/**
 * Паттерн DomainObject
 */

namespace woo\domain;

abstract class DomainObject
{
    private $id;

    function __construct($id = null)
    {
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    static function getCollection($type)
    {
        return HelperFactory::getCollection($type);
    }

    function collection()
    {
        return self::getCollection(get_class($this));
    }
}