<?php
/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo\Service\YahooMap;

require_once dirname(__FILE__) . '/../../../../../lib/Geo/Location.php';
require_once dirname(__FILE__) . '/../../../../../lib/Geo/Service.php';
require_once dirname(__FILE__) . '/../../../../../lib/Geo/Service/YahooMap/PlaceFinder.php';

class PlaceFinderTest extends \PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->service = new PlaceFinder;
    $this->service->setLanguage('it_IT');
  }

  public function testSearch()
  {
    $this->service->search('Milano');
    $results = $this->service->getResults();

    $this->assertEquals('1', count($results));
    
    $this->assertInstanceOf('\Geo\Location', $results['0']);
    $this->assertEquals('45.468945', $results['0']->getLatitude());
    $this->assertEquals('9.181030', $results['0']->getLongitude());
    $this->assertEquals('Milano MI', $results['0']->getAddress());
    $this->assertEquals(0, $this->service->getStatus());
  }
}
