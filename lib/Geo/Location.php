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

    public function setLatitude(float $v)
    {
        $this->latitude = $v;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLongitude(float $v)
    {
        $this->longitude = $v;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function distance(Location $location): float
    {
        return 1.0;
    }

}
