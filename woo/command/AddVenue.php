<?php

namespace woo\command;

use woo\controller\Request;
use woo\domain\Venue;

class AddVenue extends Command
{
    function doExecute(Request $request)
    {
        $name = $request->getProperty('venue_name');

        if (!$name) {
            $request->addFeedback('Имя не задано');

            return self::statuses('CMD_INSUFFICIENT_DATA');
        } else {
            $venue_obj = new Venue(null, $name);
            $request->setObject('venue', $venue_obj);
            $request->addFeedback('name added');

            return self::statuses('CMD_OK');
        }
    }
}