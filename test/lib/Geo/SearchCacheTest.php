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
    $this->search = $this->getMock('Geo\Search', array('query', 'getResults'));
    $this->user = $this->getMock('myUser', array('getAttribute', 'setAttribute'));
    $this->cache = new SearchCache($this->search, $this->user);
  }

  public function testQuery()
  {
    $this->user->
            expects($this->exactly(3))->
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

    $this->cache->query('Roma');
    $this->cache->query('Roma');
    $this->cache->query('Roma');
  }
}