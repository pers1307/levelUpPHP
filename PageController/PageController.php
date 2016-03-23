<?php

require_once '../woo/domain/Venue.php';

try {
    $venues = Venue::findAll();
} catch (Exception $e) {
    include 'error.php';
    exit(0);
}
?>

<!--Здесь уже непосредственно представление-->