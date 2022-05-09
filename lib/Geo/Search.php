<?php

/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 */

namespace Geo;

use ArrayObject;

/**
 * Search is the main class that expones interfaces to search through the registered services
 *
 * @package    geoadapter
 * @subpackage search
 * @author     Francesco Trucchia <francesco@trucchia.it>
 */
final class Search
{
    /**
     * @var ArrayObject
     */
    private $services;

    /**
     * @var array
     */
    private $results;

    protected function configure(): void
    {
        
    }

    public function __construct(array $services = [])
    {
        $this->results = new \ArrayObject([]);
        $this->services = new \ArrayObject($services);
        $this->configure();
    }

    public function addService(Service $service): void
    {
        $this->services->append($service);
    }

    public function setResults(ArrayObject $results): void
    {
        $this->results = $results;
    }

    public function getResults(): ArrayObject
    {
        return $this->results;
    }

    public function query(string $q, int $service_index = 0, \Exception $e = null): void
    {
        if (!isset($this->services[$service_index])) {
            throw $e !== null ? $e : new Exception\InvalidService('Service is not set');
            ;
        }

        try {
            $this->services[$service_index]->search($q);
            $this->results = clone $this->services[$service_index]->getResults();
        } catch (\Exception $e) {
            $this->query($q, ++$service_index, $e);
        }
    }

    public function getResult(int $index): ?Location
    {
        if (!isset($this->results[$index])) {
            return null;
        }

        return $this->results[$index];
    }

    public function getFirst(): Location
    {
        return !isset($this->results[0])? : $this->results[0];
    }

    public function getServices(): ArrayObject
    {
        return $this->services;
    }

    public function getService(int $index): Service
    {
        return $this->services[$index];
    }

}

