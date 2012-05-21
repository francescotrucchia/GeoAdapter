<?php
/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo\Service\OpenStreetMap;

require_once dirname(__FILE__) . '/../../../../../lib/Geo/Location.php';
require_once dirname(__FILE__) . '/../../../../../lib/Geo/Service.php';
require_once dirname(__FILE__) . '/../../../../../lib/Geo/Service/OpenStreetMap/Nominatim.php';

class NominatimTest extends \PHPUnit_Framework_TestCase
{
  public function setUp()
  {
    $this->service = new Nominatim;
    $this->service->setRegion('IT');
  }

  public function testSearch()
  {
    $this->service->search('Milano');
    $results = $this->service->getResults();

    $this->assertEquals('9', count($results));

    $this->assertInstanceOf('\Geo\Location', $results['0']);
    $this->assertEquals('45.461320', number_format($results['0']->getLatitude(), 6));
    $this->assertEquals('9.122941', number_format($results['0']->getLongitude(), 6));
    $this->assertEquals('Milano, Lombardia, Italia', $results['0']->getAddress());
  }
}
