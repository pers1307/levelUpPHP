<?php

namespace woo\mapper;

use woo\domain\DomainObject;
use woo\domain\Venue;

class VenueMapper extends Mapper
{
    function __construct()
    {
        parent::__construct();

        $this->selectStmt = self::$PDO->prepare(
            "SELECT * FROM venue WHERE id=?"
        );
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE venue SET name=?, id=? WHERE id=?"
        );
        $this->insertStmt = self::$PDO->prepare(
            "INSERT into venue (name) values(?)"
        );
    }

    function getCollection(array $raw)
    {
        return new SpaceCollection($raw, $this);
    }

    protected function doCreateObject(array $array)
    {
        $obj = new Venue($array['id']);
        $obj->setName($array['name']);

        return $obj;
    }

    protected function doInsert(DomainObject $object)
    {
        $values = [$object->getName()];
        $this->insertStmt->execute($values);
        $id = self::$PDO->lastInsertId();
        $object->setId($id);
    }

    function update(DomainObject $object)
    {
        $values = [
            $object->getName(),
            $object->getId(),
            $object->getId()
        ];

        $this->updateStmt->execute($values);
    }

    function selectStmt()
    {
        return $this->selectStmt();
    }
}