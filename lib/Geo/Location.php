<?php

namespace Geo;

class Location
{
  private $latitude;
  private $longitude;
  
  public function setLatitude($v)
  {
    $this->latitude = $v;
  }

  public function getLatitude()
  {
    return $this->latitude;
  }

  public function setLongitude($v)
  {
    $this->longitude = $v;
  }

  public function getLongitude()
  {
    return $this->longitude;
  }

  public function distance(Location $location)
  {
    $latA = deg2rad($this->latitude);
    $lonA = deg2rad($this->longitude);
    $latB = deg2rad($location->getLatitude());
    $lonB = deg2rad($location->getLongitude());

    return sprintf('%.2f', acos(sin($latA)*sin($latB) + cos($latA) * cos($latB) * cos($lonB - $lonA)) * 3956);
  }
}