<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo;

require_once dirname(__FILE__) . '/../../../lib/Geo/Location.php';

class LocationTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Location;
        $this->object->setLatitude('1.1234');
        $this->object->setLongitude('2.4321');
        $this->object->setAddress('via montenapoleone, Roma, Italia');
    }

    public function testGetLatitude()
    {
        $this->assertEquals('1.1234', $this->object->getLatitude());
    }

    public function testGetLongitude()
    {
        $this->assertEquals('2.4321', $this->object->getLongitude());
    }

    public function testGetAddress()
    {
        $this->assertEquals('via montenapoleone, Roma, Italia', $this->object->getAddress());
    }

    public function testDistance()
    {
        $this->object->setLatitude('37.5024825');
        $this->object->setLongitude('15.0878345');

        $location = $this->getMock('Geo\Location', array('getLatitude', 'getLongitude'));
        $location->expects($this->once())
                ->method('getLatitude')
                ->will($this->returnValue('37.502482500000'));

        $location->expects($this->once())
                ->method('getLongitude')
                ->will($this->returnValue('15.087834500000'));
        // the argument is treated as a float, and presented as a floating-point number (locale aware)
        $this->assertEquals(sprintf("%f", "0.00"), sprintf("%f", $this->object->distance($location)));
    }

}
