<?php

namespace Geo\Service\GoogleMap;

class GeoCode extends \Geo\Service
{
  public function initLocation($values)
  {
    $location = new \Geo\Location;
    !isset($values['geometry']['location']['lat'])?:$location->setLatitude($values['geometry']['location']['lat']);
    !isset($values['geometry']['location']['lng'])?:$location->setLongitude($values['geometry']['location']['lng']);

    return $location;
  }

  public function query($q)
  {
    $name = urlencode($q);
    $baseUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address=';
    $data = file_get_contents("{$baseUrl}{$name}&&sensor=false");

    $locations = json_decode($data, true);
    return $locations['results'];
  }
}
