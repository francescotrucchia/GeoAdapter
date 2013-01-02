# GeoAdapter [![Build Status](https://secure.travis-ci.org/francescotrucchia/GeoAdapter.png)](http://travis-ci.org/francescotrucchia/GeoAdapter)

With GeoAdapter you can find a location from an address. A location is a object with latitude and longitude attribute.
Location object implements a method can calculate distance between two location.

<pre><code>
require_once(__DIR__.'/../lib/Geo/Autoload.php');

$loader = new Geo\ClassLoader('Geo', dirname(__DIR__.'/../lib/Geo'));
$loader->register();

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
</code></pre>
