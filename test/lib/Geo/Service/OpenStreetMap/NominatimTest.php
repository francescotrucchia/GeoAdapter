<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 */

namespace Geo\Service\OpenStreetMap;

use Geo\Location;
use PHPUnit\Framework\TestCase;

class NominatimTest extends TestCase
{
    public function setUp(): void
    {
        $this->service = new Nominatim;
        $this->service->setRegion('IT');
        $this->service->setLanguage('it');
    }

    public function testSearch(): void
    {
        $this->service->search('Milano');
        $results = $this->service->getResults();

        $this->assertEquals('10', count($results));

        $this->assertInstanceOf(Location::class, $results['0']);
        $this->assertEquals('45.464194', number_format($results['0']->getLatitude(), 6));
        $this->assertEquals('9.189635', number_format($results['0']->getLongitude(), 6));
        $this->assertEquals('Milano, Lombardia, Italia', $results['0']->getAddress());
    }

}
