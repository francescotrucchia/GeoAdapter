<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
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
    protected $status;
    protected $service_results;
    protected $name;
    protected $uri;
    protected $parameters = array();

    /**
     * @param string
     * @return array
     */
    abstract protected function query($q);

    abstract protected function initLocation($values);

    private function hydrate($results)
    {
        foreach ($results as $result) {
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

    public function getStatus()
    {
        return $this->status;
    }

    public function getServiceResults()
    {
        return $this->service_results;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getName()
    {
        return $this->name;
    }

    public function search($q)
    {
        $this->results->exchangeArray(array());

        $results = $this->query($q);

        $this->service_results = $results;

        if (!is_array($results)) {
            throw new \Exception('Query method need to return an array');
        }

        if (empty($results) || count($results) == 0) {
            throw new Exception\NoResults('No location "' . $q . '" found');
        }

        $this->hydrate($results);
    }

}

