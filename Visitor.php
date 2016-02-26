<?php
/**
 * Суть паттерна в том, что есть некий главный класс, который имеет интерфейсы
 * для добавления/удаления и общий метод.
 *
 * От этого класса могут унаследоваться как листья, так и композиты, которые могут вобрать в себя листья.
 * Но, круто то, и композиты могут вобрать в себя композиты.
 * 240
 */

/**
 * Class UnitException
 * Реализация исключения, которая будет использоваться в классах листьях
 */
class UnitException extends \Exception
{

}

/**
 * Class Unit
 * Супер класс, являющейся супер типом из которого будут реализовываться и "листья"
 * и композиты
 */
abstract class Unit
{
    function addUnit(Unit $unit)
    {
        throw new UnitException(get_class($this) . 'относится к "листьям"');
    }

    function removeUnit(Unit $unit)
    {
        throw new UnitException(get_class($this) . 'относится к "листьям"');
    }

    abstract function bombardStrength();
}

/**
 * Class Archer
 * Наследник от Unit, класс "листья"
 */
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

/**
 * Class Army
 * Класс композит
 */
class Army extends Unit
{
    private $units  = [];

    function addUnit(Unit $unit)
    {
        if (in_array($unit, $this->units, true)) {
            return;
        }

        $this->units[] = $unit;
    }

    function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($this->units,
            [$unit],
            function ($a, $b) {return ($a === $b) ? 0 : 1; }
        );
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

$main_army = new Army();

$main_army->addUnit( new Archer());
$main_army->addUnit( new LaserCannonUnit());

$sub_army = new Army();

$sub_army->addUnit( new Archer());
$sub_army->addUnit( new Archer());
$sub_army->addUnit( new Archer());

$main_army->addUnit($sub_army);

echo $main_army->bombardStrength();

var_dump($main_army);
var_dump($sub_army);
