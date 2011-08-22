<?php
/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo;

class SearchCacheTest extends \PHPUnit_Framework_TestCase
{
  protected $search;

  protected function setUp()
  {
    $this->search = $this->getMock('Geo\Search', array('query', 'getResults', 'getFirst'));
    $this->user = $this->getMock('myUser', array('getAttribute', 'setAttribute'));
    $this->location = $this->getMock('Geo\Location');
    $this->cache = new SearchCache($this->search, $this->user);
  }

  public function testQuery()
  {
    $this->location->
            expects($this->exactly(3))->
            method('getAddress')->
            will($this->returnValue('roma'));

    $this->user->
            expects($this->at(0))->
            method('setAttribute')->
            with('last_query', 'roma');

    $this->user->
            expects($this->at(1))->
            method('setAttribute')->
            with('last_search', 'roma');

    $this->user->
            expects($this->at(2))->
            method('setAttribute')->
            with('last_query', 'roma');

    $this->user->
            expects($this->at(3))->
            method('setAttribute')->
            with('last_search', 'roma');
    
    $this->search->
            expects($this->exactly(1))->
            method('query')->
            with('roma', 0, null);

    $this->search->
            expects($this->exactly(1))->
            method('getResults')->
            will($this->returnValue(array()));

    $this->search->
            expects($this->exactly(3))->
            method('getFirst')->
            will($this->returnValue($this->location));

    $this->cache->query('Roma');
    $this->cache->query('Roma');
    $this->cache->query('Roma');
  }
}