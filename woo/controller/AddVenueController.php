<?php

namespace woo\controller;

use woo\domain\Venue;

class AddVenueController extends PageController
{
    function process()
    {
        try {
            $request = $this->getRequest();
            $name = $request->getProperty('venue_name');

            if (is_null($request->getProperty('submitted'))) {
                $request->addFeedback('Выберете имя заведения');
                $this->forward('AddVenue.php');
            } elseif ($name) {
                $request->addFeedback('Имя должно быть обязательно задано');
                $this->forward('AddVenue.php');
            }

            $venue = new Venue(null, $name);
            $this->forward('ListVenues.php');
        } catch (\Exception $e) {
            $this->forward('error.php');
        }
    }
}

$controller = new AddVenueController();
$controller->process();