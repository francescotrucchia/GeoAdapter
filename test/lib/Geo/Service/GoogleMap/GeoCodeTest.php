<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo\Service\GoogleMap;

require_once dirname(__FILE__) . '/../../../../../lib/Geo/Location.php';
require_once dirname(__FILE__) . '/../../../../../lib/Geo/Service.php';
require_once dirname(__FILE__) . '/../../../../../lib/Geo/Service/GoogleMap/GeoCode.php';

class GeoCodeTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->service = new GeoCode;
        $this->service->setLanguage('IT');
    }

    public function testSearch()
    {
        $this->service->search('Milano');
        $results = $this->service->getResults();

        $this->assertEquals('3', count($results));

        $this->assertInstanceOf('\Geo\Location', $results['0']);
        $this->assertEquals('45.4654542', $results['0']->getLatitude());
        $this->assertEquals('9.186516', $results['0']->getLongitude());
        $this->assertEquals('Milano, Italia', $results['0']->getAddress());
        $this->assertEquals('OK', $this->service->getStatus());
    }

}
