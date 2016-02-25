<?php

abstract class Unit
{
    abstract function bombardStrength();
}

class Archer extends Unit
{
    function bombardStrength()
    {
        return 4;
    }
}

class LaserCannonUnit extends Unit
{
    function bombardStrength()
    {
        return 44;
    }
}

class Army
{
    private $units = [];

    function addUnit(Unit $unit)
    {
        array_push($this->units, $unit);
    }

    function bombardStrength()
    {
        $ret = 0;

        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }

        return $ret;

    }
}