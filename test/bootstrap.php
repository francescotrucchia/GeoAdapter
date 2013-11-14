<?php
/**
 * This file is part of the GeoAdapter software.
 * (c) 2011 Francesco Trucchia <francesco@trucchia.it>
 */

require_once __DIR__.'/../lib/Geo/Autoload.php';

setlocale(LC_ALL, 'en_GB');

$classLoader = new Geo\ClassLoader('Geo', __DIR__ . '/../lib');
$classLoader->register();
