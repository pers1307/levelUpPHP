<?php

class Person
{
    private $_name;
    private $_age;

    function __set($property, $value)
    {
        $method = 'set' . $property;

        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
    }

    function setName($name)
    {
        $this->_name = $name;

        if (!is_null($name)) {
            $this->_name = strtoupper($this->_name);
        }
    }

    function setAge($age)
    {
        $this->_age = strtoupper($age);
    }

    function __get($property) // вызывается, если свойство не определено
    {
        $method = 'get' . $property;

        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    function __unset($property)
    {
        $method = 'set' . $property;

        if (method_exists($this, $method)) {
            return $this->$method(null);
        }
    }

    function __isset($property)
    {
        $method = 'get' . $property;

        return method_exists($this, $method);
    }

    function __call() // вызывается при обращении к несуществующему методу
    {

    }

    function getName()
    {
        return 'Ivan';
    }

    function getAge()
    {
        return 45;
    }

    function __destruct() // деструктор сайта
    {

    }

    function __clone() // правила клонирования объекта в концепции склонированного объекта.
    {
        // перед этим методом произойдет нативное копирование
        // свойства лбъекты будут копироваться по ссылке
        // исключая случаи принудительного копирования
    }

    function __toString()
    {
        return '';
    }
}

$p = new Person();
var_dump($p->name);
var_dump(isset($p->name));
$p->name = 'qwerty';
$p->age = 300;
var_dump($p);

$p2 = clone $p; // копирование объекта
$p3 = $p; // передача по ссылке
