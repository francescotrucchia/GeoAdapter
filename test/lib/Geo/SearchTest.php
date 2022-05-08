<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 */

namespace Geo;

use Geo\Exception\InvalidService;
use Geo\Exception\NoResults;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{

    protected $search;

    public function setUp(): void
    {
        $this->location = $this->createMock('\Geo\Location', array('getLatitude', 'getLongitude'));
        $this->service = $this->createMock('\Geo\Service\OpenStreetMap\Nominatim', array('search', 'getResults'));
        $this->search = new Search;
    }

    public function testServiceInConstructor()
    {
        $this->service->
                expects($this->once())->
                method('search')->
                with('Milano');

        $this->service->
                expects($this->once())->
                method('getResults')->
                will($this->returnValue(new \ArrayObject(array($this->location))));

        $search = new Search(array($this->service));
        $search->query('Milano');

        $results = $search->getResults();

        $this->assertEquals(1, count($results));
    }

    
    public function testQueryWithoutService()
    {
        $this->expectException(InvalidService::class);

        $this->search->query('Milano');
    }

    public function testQueryWithInvalidPlace()
    {
        $this->expectException(NoResults::class);

        $this->service->
                expects($this->once())->
                method('search')->
                with('questo è un indirizzo che non esiste')->
                will($this->throwException(new \Geo\Exception\NoResults));

        $this->search->addService($this->service);
        $this->search->query('questo è un indirizzo che non esiste');
    }

    public function testQuery()
    {
        $this->service->
                expects($this->once())->
                method('search')->
                with('Milano');

        $this->service->
                expects($this->once())->
                method('getResults')->
                will($this->returnValue(new \ArrayObject(array($this->location))));

        $this->search->addService($this->service);
        $this->search->query('Milano');

        $results = $this->search->getResults();

        $this->assertEquals(1, count($results));
        $this->assertTrue($results[0] === $this->search->getFirst() && $this->search->getFirst() === $this->search->getResult(0));
        $this->assertEquals(null, $this->search->getResult(1));
    }

}