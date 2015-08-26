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
/*
 * Load the framework constants
 */
require_once '../Library/FrameworkConstants.php';
FrameworkConstants::SetNamedConstants(array(
    FrameworkConstants::FrameworkConstants_Name_TestAppName => ""
));
/**
 * Autoload defines global variables.
 */
require_once '../Library/autoload.php';

/**
 * Class name of the application to load.
 */
$placeholder = array("{{appname}}" => FrameworkConstants_AppName);
$appClassName = strtr(
        "\Applications\{{appname}}\\{{appname}}Application", $placeholder);

try {
  session_start();
  $app = new $appClassName();
  $app->run();
} catch (\Exception $exc) {
  $errorLogger = new Library\Core\ErrorManager($exc);
  $errorLogger->LogError($exc);
  var_dump($_SESSION);
  die();
}