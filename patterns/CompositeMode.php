<?php
/**
 * Все тоже самое, только класс Unit разделен на два класса, что прибавит гемора, если появится
 * дополнительное взаимодействие между листьями и композитами
 * Но, зато мы убере лишнюю реализацию методов
 */

/**
 * Class Unit
 * Супер класс, являющейся супер типом из которого будут реализовываться и "листья"
 * и композиты
 */
abstract class Unit
{
    function getComposite()
    {
        return null;
    }

    abstract function bombardStrength();
}

abstract class CompositeUnit extends Unit
{
    private $units = [];

    function getComposite()
    {
        return $this;
    }

    protected function units()
    {
        return $this->units;
    }

    function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($this->units,
            [$unit],
            function ($a, $b) {return ($a === $b) ? 0 : 1; }
        );
    }

    function addUnit(Unit $unit)
    {
        if (in_array($unit, $this->units, true)) {
            return;
        }

        $this->units[] = $unit;
    }
}

class UnitScript
{
    static function joinExisting(
        Unit $newUnit,
        Unit $occupyingUnit
    ) {
        $comp = '';

        if (!is_null($comp = $occupyingUnit->getComposite())) {
            $comp->addUnit($newUnit);
        } else {
            $comp = new Army();
            $comp->addUnit($occupyingUnit);
            $comp->addUnit($newUnit);
        }

        return $comp;
    }
}

class TroopCarrier extends CompositeUnit
{
    function addUnit(Unit $unit)
    {
        if ($unit instanceof Cavalry) {
            throw new UnitException('Нельзя поместить лошадь на бронетранспортер');
        }

        //super::addUnit($unit);
    }

    function bombardStrength()
    {
        return 0;
    }
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