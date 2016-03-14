<?php

class StaticExample
{
    const AVAILABLE = 0;

    static public $aNum = 0;

    static public function sayHello()
    {
        self::$aNum++; // использование статической переменной внутри класса
        print ' ' . self::$aNum;
    }
}

print StaticExample::AVAILABLE;

abstract class ShopProductWriter
{
    abstract public function write(); // Абстрактный метод должен быть обязательно переопределен в наследнике
}

class TextWriter extends ShopProductWriter
{
    public function write()
    {

    }
}

interface Chargeable
{
    public function getPrice();
}

// class W extends T impaments W, WW {} можно унаследовать 2а и более интерфейсов

// Крутой хак, на создание класса (а - ля Фабрика)

abstract class DomainObject
{
    public static function create()
    {
        return new static(); // возможность создавать собственный экземпляр
    }
}

class User extends DomainObject {}
class Document extends DomainObject {}

var_dump(Document::create());

final class Check // От такого класса нельзя унаследоваться
{
    final public function checkOut() // Такой метод нельзя переопределить
    {

    }
}

