<?php

require 'Calculator.php';

class CalculatorTests extends PHPUnit_Framework_TestCase
{
    private $calculator;

    /**
     * Вызывается перед каждым тестом
     */
    protected function setUp()
    {
        $this->calculator = new Calculator();
    }

    /**
     * Вызывается после каждого теста
     */
    protected function tearDown()
    {
        $this->calculator = null;
    }

    /**
     * Все, что начинается с test будет запускаться
     */
    public function testAdd()
    {
        $result = $this->calculator->add(1, 2);
        $this->assertEquals(3, $result);
    }
}