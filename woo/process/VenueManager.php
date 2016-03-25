<?php

namespace woo\process;

class VenueManager extends Base
{
    static $add_venue = 'INSERT INTO venue (name) VALUES (?)';
    static $add_space = 'INSERT INTO space (name, venue) VALUES (?, ?)';
    static $check_slot = 'SELECT id, name FROM event';
}