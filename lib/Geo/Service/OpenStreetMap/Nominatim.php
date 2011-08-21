<?php
/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo\Service\OpenStreetMap;

use Geo\Service;

/**
 * Nominatim service wrap the Nominatim OpenStreetMap Service
 *
 * @package    geoadapter
 * @subpackage service
 * @author     Francesco Trucchia <francesco@trucchia.it>
 */
class Nominatim extends Service
{
  protected function initLocation($values)
  {
    $location = new \Geo\Location;
    !isset($values['lat'])?:$location->setLatitude($values['lat']);
    !isset($values['lon'])?:$location->setLongitude($values['lon']);
    !isset($values['display_name'])?:$location->setAddress($values['display_name']);

    return $location;
  }
  
  protected function query($q)
  {
    $name = urlencode($q);
    $baseUrl = 'http://nominatim.openstreetmap.org/search?format=json&q=';
    $data = file_get_contents("{$baseUrl}{$name}&countrycodes={$this->region}&addressdetails=1");

    return json_decode($data, true);
  }
}