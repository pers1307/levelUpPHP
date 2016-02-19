<?php

/**
 * Class Employee
 * Смысл в том, что базовый класс может знать о своих предках
 * И мы можем создавать объекты прямо из класса родителя.
 */
abstract class Employee
{
    protected $name;
    private static $types = ['Minion', 'CluedUp', 'WellConnected'];

    static function recruit($name)
    {
        $num = rand(1, count(self::$types)) - 1;
        $class = self::$types[$num];
        return new $class($name);
    }

    function __construct($name)
    {
        $this->name = $name;
    }

    abstract function fire();
}

class Minion extends Employee
{
    function fire()
    {
        echo $this->name . ': убери со стола';
    }
}

class WellConnected extends Employee
{
    function fire()
    {
        echo $this->name . ': позвони папику';
    }
}

class CluedUp extends Employee
{
    function fire()
    {
        echo $this->name . ': вызови адвоката';
    }
}

class NastyBoss
{
    private $employees = [];

    function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    function projectFails()
    {
        if (count($this->employees) > 0) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }
}

$boss = new NastyBoss();
$boss->addEmployee(Employee::recruit('Игорь'));
$boss->addEmployee(Employee::recruit('Владимир'));
$boss->addEmployee(Employee::recruit('Мария'));

var_dump($boss);

$boss->projectFails();

var_dump($boss);