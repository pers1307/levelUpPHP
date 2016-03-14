<?php

class ShopProduct
{
    public $title;
    public $producerMainName;
    public $producerFirstName;
    private $price; // Более правильно делать свойства класса приватными, а к ним писать getter и setter

    public function setPrice($price) // method's getter
    {
        $this->price = $price;
    }

    public function getPrice() // method's setter
    {
        return $this->price;
    }

    function __construct(
        $title,
        $firstName,
        $mainName,
        $price
    )
    {
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
    }

    public function getProducer()
    {
        return $this->producerFirstName . ' ' . $this->producerMainName;
    }
}

class CDProduct extends ShopProduct
{
    public $playLength;

    function __construct(
        $title,
        $firstName,
        $mainName,
        $price,
        $playLength
    )
    {
        parent::__construct($title, $firstName, $mainName, $price); // Так можно вызвать методы родителя
        $this->playLength = $playLength;
    }
}

