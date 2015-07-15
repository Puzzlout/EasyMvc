<?php
/**
 * Custom error handler to catch all the error and process them.
 */
set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
  // error was suppressed with the @-operator
  if (0 === error_reporting()) {
    return false;
  }

  throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

/**
 * Version number global variable definition
 * It is used to allow automatic client refresh of the JavaScript and CSS files.
 */
define('__VERSION_NUMBER__', '1.0.0.2');

/**
 * Allows this file to execute the autoload.
 */
define('__EXECUTION_ACCESS_RESTRICTION__', true);

/**
 * Declare the full directory path where the application resides.
 */
define('__ROOT__', dirname(dirname(__FILE__)) . '/');

/**
 * The application name which needs to match the folder name in Applications 
 * folder.
 * It also is the prefix for the Application class found in 
 * Applications/YourAppName/YourAppNameApplication.php
 * 
 * The correct tree structure should be: Applications/YourAppName/..
 */
define('__APPNAME__', 'EasyMvc');

/**
 * Depending on the server setup and where resides the application,
 * __BASEURL__ will need to be updated.
 * 
 * Examples:
 *  1) if your website root url is http://mydomain.net/MyApp/, then 
 * __BASEURL__ will be "/MyApp/".
 * 
 *  2) if your website root url is http://mydomain.net/, then 
 * __BASEURL__ will be "/".
 * 
 */
define('__BASEURL__', '/' . __APPNAME__ . '/');

/**
 * Class name of the application to load.
 */
$placeholder = array("{{appname}}" => __APPNAME__);
$appClassName = strtr(
        "\Applications\{{appname}}\\{{appname}}Application", $placeholder);

/**
 * Autoload defines global variables.
 */
require '../Library/autoload.php';

$app = new $appClassName();
try {
  $app->run();
} catch (\Exception $exc) {
  $errorLogger = new Library\Core\ErrorManager($app, $exc);
  $errorLogger->LogError($exc);
  die();
}