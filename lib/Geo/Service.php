<?php
/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo;

/**
 * Service is the adapter for the external geo searching services
 *
 * @package    geoadapter
 * @subpackage service
 * @author     Francesco Trucchia <francesco@trucchia.it>
 */
abstract class Service
{
  private $results;

  protected $region;

  protected $language;

  /**
   * @param string
   * @return array
   */
  abstract protected function query($q);

  abstract protected function initLocation($values);
  
  private function hydrate($results)
  {
    foreach($results as $result)
    {
      $this->addResult($this->initLocation($result));
    }
  }

  private function addResult(\Geo\Location $location)
  {
    $this->results->append($location);
  }

  public function __construct()
  {
    $this->results = new \ArrayObject();
  }

  public function getResults()
  {
    return $this->results;
  }

  public function setRegion($region)
  {
    $this->region = $region;
  }

  public function setLanguage($language)
  {
    $this->language = $language;
  }
  
  public function search($q)
  {
    $this->results->exchangeArray(array());
    
    $results = $this->query($q);
    
    if (!is_array($results))
    {
      throw new \Exception('Query method need to return an array');
    }
    
    if (empty($results) || count($results) == 0)
    {
      throw new Exception\NoResults('No location "'.$q.'" found');
    }

    $this->hydrate($results);
  }
}

