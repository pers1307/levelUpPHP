<?php

class Sea
{
    private $navigability = 0;

    function __construct($navigability)
    {
        $this->navigability = $navigability;
    }
}

class EarthSea extends Sea
{

}

class MarsSea extends Sea
{

}

class Plains
{

}

class EarthPlains extends Plains
{

}

class MarsPlains extends Plains
{

}

class Forest
{

}

class EarthForest extends Forest
{

}

class MarsForest extends Forest
{

}

class TerrainFactory
{
    private $sea;
    private $forest;
    private $plains;

    function __construct(Sea $sea, Plains $plains, Forest $forest)
    {
        $this->sea    = $sea;
        $this->forest = $forest;
        $this->plains = $plains;
    }

    function getSea()
    {
        return clone $this->sea;
    }

    function getPlains()
    {
        return clone $this->plains;
    }

    function getForest()
    {
        return clone $this->forest;
    }
}

class Contained
{

}

class Container
{
    public $contained;

    function __construct()
    {
        $this->contained = new Contained();
    }

    function __clone()
    {
        // Копия класса будет иметь свой объект класса
        $this->contained = clone $this->contained;
    }
}