<?php
if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

/**
 * Finds and load a class from its full name, e.g. namespace + class name.
 * It will check if the file exists in the <i>__ROOT__</i> directory.
 * 
 * If it does, it will load the class to be used.
 * Otherwise, it will throw an exception.
 * 
 * @param string $className
 */
function autoload($className) {
  $file = __ROOT__ . str_replace('\\', '/', $className) . '.php';
  if (file_exists($file)) {
    try {
      require_once $file;
    } catch (Exception $exc) {
      echo "<!--" . $exc->getMessage() . "-->";
    }
  } else {
    throw new ErrorException("Class not found => " . $file);
  }
}

spl_autoload_register('autoload');
