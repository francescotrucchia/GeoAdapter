<?php
namespace Geo;

class Autoload
{
  static public function register()
  {
    spl_autoload_register(array(new self, 'autoload'));
  }

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

