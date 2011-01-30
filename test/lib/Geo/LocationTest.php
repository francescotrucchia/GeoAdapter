<?php

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
  }

  public function testGetLatitude()
  {
    $this->assertEquals('1.1234', $this->object->getLatitude());
  }

  public function testGetLongitude()
  {
    $this->assertEquals('2.4321', $this->object->getLongitude());
  }
}