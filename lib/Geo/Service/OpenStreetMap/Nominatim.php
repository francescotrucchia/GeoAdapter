<?php

namespace Geo\Service\OpenStreetMap;

use Geo\Service;

class Nominatim extends Service
{
  protected function initLocation($values)
  {
    $location = new \Geo\Location;
    !isset($values['lat'])?:$location->setLatitude($values['lat']);
    !isset($values['lon'])?:$location->setLongitude($values['lon']);

    return $location;
  }
  
  protected function query($q)
  {
    $name = urlencode($q);
    $baseUrl = 'http://nominatim.openstreetmap.org/search?format=json&q=';
    $data = file_get_contents("{$baseUrl}{$name}&limit=1&addressdetails=1");

    return json_decode($data, true);
  }
}