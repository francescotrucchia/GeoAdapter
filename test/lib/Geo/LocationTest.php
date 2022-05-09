<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 */

namespace Geo;

use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    protected $object;

    public function setUp(): void
    {
        $this->object = new Location;
        $this->object->setLatitude(1.1234);
        $this->object->setLongitude(2.4321);
        $this->object->setAddress('via montenapoleone, Roma, Italia');
    }

    public function testGetLatitude(): void
    {
        $this->assertEquals(1.1234, $this->object->getLatitude());
    }

    public function testGetLongitude(): void
    {
        $this->assertEquals(2.4321, $this->object->getLongitude());
    }

    public function testGetAddress(): void
    {
        $this->assertEquals('via montenapoleone, Roma, Italia', $this->object->getAddress());
    }

    public function testDistance(): void
    {
        $locationA = new Location();
        $locationA->setLatitude(45.4641943);
        $locationA->setLongitude(9.1896346);

        $locationB = new Location();
        $locationB->setLatitude(43.7698712);
        $locationB->setLongitude(11.2555757);

        $distance = $locationA->distance($locationB);

        $this->assertEquals(249.73, $distance);
    }

}
