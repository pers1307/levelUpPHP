<?php

class ViewHelper
{
    static function getRequest()
    {
        return \woo\base\RequestRegistry::getRequest();
    }
}