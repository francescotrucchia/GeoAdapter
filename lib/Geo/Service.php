<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 */

namespace Geo;

use ArrayObject;

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

    abstract protected function query(string $q): array;

    abstract protected function initLocation(array $values): Location;

    private function hydrate(array $results): void
    {
        foreach ($results as $result) {
            $this->addResult($this->initLocation($result));
        }
    }

    private function addResult(\Geo\Location $location): void
    {
        $this->results->append($location);
    }

    public function __construct()
    {
        $this->results = new \ArrayObject();
    }

    public function getResults(): ArrayObject
    {
        return $this->results;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getServiceResults(): array
    {
        return $this->service_results;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function search(string $q): void
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

