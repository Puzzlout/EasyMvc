<?php

function autoload($class) {
  $file = __ROOT__ . str_replace('\\', '/', $class) . '.php';
  if (file_exists($file)) {
    try {
      require_once $file;
    } catch (Exception $exc) {
      echo "<!--" . $exc->getMessage() . "-->";
    }
  }
}

/**
 * The application name which needs to match the folder name in Applications folder
 * 
 * The correct tree structure should be: Applications > AppName
 */
define('__APPNAME__', 'EasyMVC');

define('__EXECUTION_ACCESS_RESTRICTION__', true);
define('__BASEURL__', '/' . __APPNAME__ . '/');
define('__ROOT__', dirname(dirname(__FILE__)) . '/');

/**
 * Class name of the application to load
 */
$appClassName = "\Applications\\" . __APPNAME__ . "\WebApplication";

spl_autoload_register('autoload');
