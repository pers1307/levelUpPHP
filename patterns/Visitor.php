<?php
/**
 * Позволяет обойти все дерево и собрать информацию
 */

/**
 * Class ArmyVisitor
 */
abstract class ArmyVisitor
{
    abstract function visit($node);

    function visitArcher(Archer $node)
    {
        $this->visit($node);
    }

    function visitCavalry(Cavalry $node)
    {
        $this->visit($node);
    }

    function visitLaserCannonUnit(LaserCannonUnit $node)
    {
        $this->visit($node);
    }

    function visitTroopCarrierUnit(TroopCarrierUnit $node)
    {
        $this->visit($node);
    }

    function visitArmy($node)
    {
        $this->visit($node);
    }
}

class TextDumpArmyVisitor extends ArmyVisitor
{
    private $text = '';

    function visit($node)
    {
        $ret = '';
        $pad = 4 * $node->getDepth();
        $ret .= $pad;
        $ret .= get_class($node) . ': ';
        $ret .= 'Огневая мощь: ' . $this->bombardStrength();

        $this->text .= $ret;
    }

    function getText()
    {
        return $this->text;
    }
}

class TaxCollectionVisitor extends ArmyVisitor
{
    private $due = 0;
    private $report = '';

    function visit($node)
    {
        $this->levy($node, 1);
    }

    function visitArcher(Archer $node)
    {
        $this->visit($node, 2);
    }

    function visitCavalry(Cavalry $node)
    {
        $this->visit($node, 3);
    }

    function visitLaserCannonUnit(LaserCannonUnit $node)
    {
        $this->visit($node, 5);
    }

    private function levy(Unit $unit, $amount)
    {
        $this->report .= 'Налог для ' . get_class($unit);
        $this->report .= ': ' . $amount;
        $this->due += $amount;
    }

    function getReport()
    {
        return $this->report;
    }

    function getTax()
    {
        return $this->due;
    }
}

/**
 * Class Unit
 * Супер класс, являющейся супер типом из которого будут реализовываться и "листья"
 * и композиты
 */
abstract class Unit
{
    protected $depth;

    function getComposite()
    {
        return null;
    }

    function textDump($num = 0)
    {
        $ret  = '';
        $pad  = 4 * $num;
        $ret .= $pad;
        $ret .= get_class($this) . ': ';
        $ret .= 'огневая мощь: ' . $this->bombardStrength();

        return $ret;
    }

    function accept(ArmyVisitor $visitor)
    {
        $method = 'visit' . get_class($this);
        $visitor->$method($method);
    }

    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function getDepth($depth)
    {
        return $this->depth;
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
        foreach ($this->units as $thisUnit) {
            if ($unit === $thisUnit) {
                return;
            }
        }

        $unit->setDepth($this->depth + 1);
        $this->units[] = $unit;
    }

    function textDump($num = 0)
    {
        $ret = parent::textDump($num);

        foreach ($this->units as $unit) {
            $ret .= $unit->textDump($num + 1);
        }

        return $ret;
    }

    function accept(ArmyVisitor $visitor)
    {
        parent::accept($visitor);

        foreach ($this->units as $thisUnit) {
            $thisUnit->accept($visitor);
        }
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

class Cavalry extends Unit
{
    function bombardStrength()
    {
        return 100;
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
$main_army->addUnit(new Archer());
$main_army->addUnit(new LaserCannonUnit());
$main_army->addUnit(new Cavalry());

$taxCollector = new TaxCollectionVisitor();
$main_army->accept($taxCollector);
echo $taxCollector->getReport();
echo $taxCollector->getTax();

$textDump = new TextDumpArmyVisitor();
$main_army->accept($textDump);
print $textDump->getText();