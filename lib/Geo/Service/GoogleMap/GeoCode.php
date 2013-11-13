<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo\Service\GoogleMap;

/**
 * GeoCode service wrap the Google Location Service
 *
 * @package    geoadapter
 * @subpackage service
 * @author     Francesco Trucchia <francesco@trucchia.it>
 */
class GeoCode extends \Geo\Service
{

    protected $name = 'google geocoding';
    protected $uri = "http://maps.googleapis.com/maps/api/geocode/json";

    public function initLocation($values)
    {
        $location = new \Geo\Location;
        !isset($values['geometry']['location']['lat'])? : $location->setLatitude($values['geometry']['location']['lat']);
        !isset($values['geometry']['location']['lng'])? : $location->setLongitude($values['geometry']['location']['lng']);
        !isset($values['formatted_address'])? : $location->setAddress($values['formatted_address']);

        return $location;
    }

    public function query($q)
    {
        $uri = 'http://maps.googleapis.com/maps/api/geocode/json';
        $parameters = array(
            'address' => $q,
            'region' => $this->region,
            'sensor' => 'false',
            'language' => $this->language
        );

        $data = @file_get_contents($uri . '?' . \http_build_query($parameters));

        $locations = json_decode($data, true);
        $this->status = $locations['status'];
        return $locations['results'];
    }

}
