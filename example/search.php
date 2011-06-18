<?php

require_once(__DIR__.'/../lib/Geo/Autoload.php');

Geo\Autoload::register();

class Search extends Geo\Search
{
  protected function configure()
  {
    $this->addService(new Geo\Service\OpenStreetMap\Nominatim);
    $this->addService(new Geo\Service\GoogleMap\GeoCode);
  }
}


$search = new Search();

$search->query('via Montenapoleone, Milano');

$location_a = $search->getFirst();

$search->query('piazza Boccolino, Osimo');

$location_b = $search->getFirst();

echo 'Address1: via Montenapoleone, Milano'.PHP_EOL;
echo 'Latitude: '.$location_a->getLatitude().PHP_EOL;
echo 'Longitude: '.$location_a->getLongitude().PHP_EOL.PHP_EOL;

echo 'Address2: piazza Boccolino, Osimo'.PHP_EOL;
echo 'Latitude: '.$location_b->getLatitude().PHP_EOL;
echo 'Longitude: '.$location_b->getLongitude().PHP_EOL.PHP_EOL;

echo 'Distance from Address1 to Address2: '.$location_a->distance($location_b).' Km'.PHP_EOL;
