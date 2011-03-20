<?php
/**
 * This file is part of the %package_name% package.
 * (c) 2011 %author_name% <%author_email%>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Geo;

/**
 * Search execute geo query using different driver. The driver should be configured in configure method or they can be added
 * with
 *
 * @package    symfony
 * @subpackage action
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <sean@code-box.org>
 * @version    SVN: $Id: sfAction.class.php 24279 2009-11-23 15:21:18Z fabien $
 */
class Search
{
  private $services;
  private $results = array();

  protected function configure() {}
  
  public function __construct($services = array())
  {
    $this->services = new \ArrayObject($services);
    $this->configure();
  }

  public function addService(Service $service)
  {
    $this->services->append($service);
  }

  public function setResults($results)
  {
    $this->results = $results;
  }

  public function getResults()
  {
    return $this->results;
  }

  public function query($q, $service_index = 0, $e = null)
  {    
    if (!isset($this->services[$service_index]))
    {
      throw $e !== null?$e:new Exception\InvalidService('Service is not set');;
    }

    try
    {
      $this->services[$service_index]->search($q);
      $this->results = $this->services[$service_index]->getResults();
    }
    catch(\Exception $e)
    {
      $this->query($q, ++$service_index, $e);
    }

  }

  public function getResult($index)
  {
    if (!isset($this->results[$index]))
    {
      return;
    }
    
    return $this->results[$index];
  }

  public function getFirst()
  {
    return !isset($this->results[0])?:$this->results[0];
  }
}

