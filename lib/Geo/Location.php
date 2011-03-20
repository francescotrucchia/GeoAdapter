<?php
/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo;

/**
 * Location is the model for a geo point
 *
 * @package    geoadapter
 * @subpackage search
 * @author     Francesco Trucchia <francesco@trucchia.it>
 */
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