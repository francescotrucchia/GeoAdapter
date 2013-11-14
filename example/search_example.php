<?php

require_once(__DIR__.'/../lib/Geo/Autoload.php');

$loader = new Geo\ClassLoader('Geo', dirname(__DIR__.'/../lib/Geo'));
$loader->register();

$search = new Geo\Search();
$search->addService(new Geo\Service\GoogleMap\GeoCode);

$search->query('Milano');
$location_a = $search->getFirst();

$search->query('Firenze');
$location_b = $search->getFirst();

$distance = $location_a->distance($location_b);

echo "Distance from Milano to Firenze is $distance Km".PHP_EOL;