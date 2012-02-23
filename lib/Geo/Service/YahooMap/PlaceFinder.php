<?php
/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo\Service\YahooMap;

/**
 * YahooMap service wrap the Yahoo Place Finder Service
 *
 * @package    geoadapter
 * @subpackage service
 * @author     Francesco Trucchia <francesco@trucchia.it>
 */
class PlaceFinder extends \Geo\Service
{
  protected $name = 'yahoo place finder';
  protected $uri = 'http://where.yahooapis.com/geocode';
  protected $appid = 'dj0yJmk9TDdQczR5d3RINll3JmQ9WVdrOVRYYzFZVTlZTXpJbWNHbzlNemswT0RnNU16WXkmcz1jb25zdW1lcnNlY3JldCZ4PWI5';
  
  public function initLocation($values)
  {
    $location = new \Geo\Location;
    
    $address = array();
    
    if($values['line1'])
    {
      array_push($address, $values['line1']);
    }
    
    if($values['line2'])
    {
      array_push($address, $values['line2']);
    }
    
    !isset($values['latitude'])?:$location->setLatitude($values['latitude']);
    !isset($values['longitude'])?:$location->setLongitude($values['longitude']);
    !count($address)?:$location->setAddress(\implode(', ', $address));

    return $location;
  }

  public function query($q)
  {
    $parameters = array(
        'q' => $q,
        'appid' => $this->appid,
        'flags' => 'P',
        'locale' => $this->language
    );

    $data = @file_get_contents($this->uri.'?'.  \http_build_query($parameters));
    
    $locations = unserialize($data);
    
    $this->status = $locations['ResultSet']['Error'];
    return $locations['ResultSet']['Result'];
  }
}
