# GeoAdapter

With GeoAdapter you can find a location from an address. A location is a object with latitude and longitude attribute.
Location object implements a method can calculate distance between two location.

``` php
<?php

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

$distance = $location_a->distance($location_b);

echo "Distance from Milano to Firenze is $distance Km".PHP_EOL;
```

This software is released under GPL license.
