<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
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
        !isset($values['lat'])? : $location->setLatitude($values['lat']);
        !isset($values['lon'])? : $location->setLongitude($values['lon']);
        !isset($values['display_name'])? : $location->setAddress($values['display_name']);

        return $location;
    }

    protected function query($q)
    {
        $uri = 'http://nominatim.openstreetmap.org/search';
        $parameters = array(
            'format' => 'json',
            'q' => $q,
            'countrycodes' => $this->region,
            'accept-language' => $this->language,
            'addressdetails' => 1
        );

        $data = file_get_contents($uri . '?' . \http_build_query($parameters));

        return json_decode($data, true);
    }

}