<?php

require_once(__DIR__ . '/../lib/Geo/Autoload.php');

$loader = new Geo\ClassLoader('Geo', dirname(__DIR__ . '/../lib/Geo'));
$loader->register();

class Search extends Geo\Search
{
    protected function configure()
    {
        $service = new Geo\Service\OpenStreetMap\Nominatim();
        $service->setRegion('IT');
        $service->setLanguage('it');
        $this->addService($service);
    }
}

$search = new Search();

try {
    $search->query('via Montenapoleone, Milano');
    $location_a = $search->getFirst();
    echo 'Address1: ' . $location_a->getAddress() . PHP_EOL;
    echo 'Latitude: ' . $location_a->getLatitude() . PHP_EOL;
    echo 'Longitude: ' . $location_a->getLongitude() . PHP_EOL . PHP_EOL;
} catch (Exception $e) {
    $services = $search->getServices();
    echo 'Status: ' . $services[0]->getStatus() . PHP_EOL;
    echo 'Service results: ' . print_r($services[0]->getServiceResults()) . PHP_EOL;
}


try {
    $search->query('corso mazzini, Osimo');
    $location_b = $search->getFirst();
    echo 'Address2: ' . $location_b->getAddress() . PHP_EOL;
    echo 'Latitude: ' . $location_b->getLatitude() . PHP_EOL;
    echo 'Longitude: ' . $location_b->getLongitude() . PHP_EOL . PHP_EOL;
} catch (Exception $e) {
    $services = $search->getServices();
    echo 'Status: ' . $services[0]->getStatus() . PHP_EOL;
    echo 'Service results: ' . print_r($services[0]->getServiceResults()) . PHP_EOL;
}

if (isset($location_a) && isset($location_b)) {
    echo 'Distance from Address1 to Address2: ' . $location_a->distance($location_b) . ' Km' . PHP_EOL;
}


