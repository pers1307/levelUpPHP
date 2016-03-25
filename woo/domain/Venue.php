<?php

namespace woo\domain;

class Venue extends DomainObject
{
    private $name;
    private $spaces;

    function __construct($id = null, $name = null)
    {
        $this->name = $name;
        $this->spaces = self::getCollection('woo\\domain\\Space');
        parent::__construct($id);
    }

    function setSpaces(SpaceCollection $spaces)
    {
        $this->spaces = $spaces;
    }

    function getSpaces()
    {
        return $this->spaces;
    }

    function addSpace(Space $space)
    {
        $this->spaces->add($space);
        $space->setVenue($this);
    }

    function setName($name_s)
    {
        $this->name = $name_s;
        $this->markDirty();
    }

    function getName()
    {
        return $this->name;
    }
}