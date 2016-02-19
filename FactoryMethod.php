<?php

abstract class ApptEncoder
{
    abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder
{
    function encode()
    {
        return 'Данные о встрече закодорованы в формате BloggsCal';
    }
}

class MegaApptEncoder extends ApptEncoder
{
    function encode()
    {
        return 'Данные о встрече закодированы в формате MegaCal';
    }
}

class CommsManager
{
    const BLOGGS = 1;
    const MEGA   = 2;

    private $mode = 1;

    function __construct($mode)
    {
        $this->mode = $mode;
    }

    function getApptEncoder()
    {
        switch($this->mode)
        {
            case (self::MEGA):
                return new MegaApptEncoder();
            default:
                return new BloggsApptEncoder();
        }
    }
}

$comms = new CommsManager(CommsManager::MEGA);
$apptEncoder = $comms->getApptEncoder();
echo $apptEncoder->encode();