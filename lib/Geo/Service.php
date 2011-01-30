<?php

namespace Geo;

abstract class Service
{
  private $results;

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

