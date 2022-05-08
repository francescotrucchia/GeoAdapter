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
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://nominatim.openstreetmap.org/search', [
            'query' => [
                'format' => 'json',
                'q' => $q,
                'countrycodes' => $this->region,
                'accept-language' => $this->language,
                'addressdetails' => 1    
            ]
        ]);
        

        

        return json_decode((string)$response->getBody(), true);
    }

}