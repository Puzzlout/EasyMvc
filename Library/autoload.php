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
 * It also is the prefix for the Application class found in Applications/YourAppName/YourAppNameApplication.php
 * 
 * The correct tree structure should be: Applications/YourAppName
 */
define('__APPNAME__', 'EasyMvc');

define('__EXECUTION_ACCESS_RESTRICTION__', true);
define('__BASEURL__', '/' . __APPNAME__ . '/');
define('__ROOT__', dirname(dirname(__FILE__)) . '/');

/**
 * Class name of the application to load
 */

$placeholder = array("{{appname}}" => __APPNAME__);
$appClassName =  strtr("\Applications\\{{appname}}\\{{appname}}Application", $placeholder);

spl_autoload_register('autoload');
