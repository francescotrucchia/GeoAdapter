<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 */

require_once __DIR__ . '/../vendor/autoload.php';

$search = new Geo\Search();
$search->addService(new Geo\Service\OpenStreetMap\Nominatim());

$search->query('Milano');
$location_a = $search->getFirst();

$search->query('Firenze');
$location_b = $search->getFirst();

echo 'Address1: via Montenapoleone, Milano'.PHP_EOL;
echo 'Latitude: '.$location_a->getLatitude().PHP_EOL;
echo 'Longitude: '.$location_a->getLongitude().PHP_EOL.PHP_EOL;

echo 'Address2: piazza Boccolino, Osimo'.PHP_EOL;
echo 'Latitude: '.$location_b->getLatitude().PHP_EOL;
echo 'Longitude: '.$location_b->getLongitude().PHP_EOL.PHP_EOL;

//$distance = $location_a->distance($location_b);

//echo "Distance from Milano to Firenze is $distance Km".PHP_EOL;