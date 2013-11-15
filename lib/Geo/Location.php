<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
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

    protected $latitude;
    protected $longitude;
    protected $address;

    /**
     * Set latitude
     * 
     * @param float $v
     */
    public function setLatitude($v)
    {
        $this->latitude = $v;
    }

    /**
     * Get latitude
     * 
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $v
     */
    public function setLongitude($v)
    {
        $this->longitude = $v;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get Address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

}
