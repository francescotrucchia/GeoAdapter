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
 * Autoload
 *
 * @package    geoadapter
 * @subpackage search
 * @author     Francesco Trucchia <francesco@trucchia.it>
 */
class Autoload
{
  /**
   * Register the autoload method
   */
  static public function register()
  {
    spl_autoload_register(array(new self, 'autoload'));
  }

  /**
   * Autoload classes
   * 
   * @param string $class_name
   * @return mixed
   */
  public function autoload($class_name)
  {
    if (!strstr($class_name, 'Geo'))
    {
      return;
    }

    $filename = __DIR__.'/../'.  \str_replace('\\', '/', $class_name).'.php';

    if (\file_exists($filename))
    {
      require_once $filename;
    }
  }
}

