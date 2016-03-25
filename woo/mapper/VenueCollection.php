<?php

namespace woo\mapper;

class VenueCollection extends Collection
{
    function targetClass()
    {
        return 'woo\domain\Venue';
    }
}