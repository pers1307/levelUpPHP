<?php

class ShopProduct
{
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

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