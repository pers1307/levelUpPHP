<?php

/**
 * Class CommsManager
 */
abstract class CommsManager
{
    /**
     * @return mixed
     */
    abstract function getHeaderText();
    abstract function getApptEncoder();
    abstract function getTtdEncoder();
    abstract function getContactEncoder();
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager
{
    /**
     * Реализация этих методов
     */
}

