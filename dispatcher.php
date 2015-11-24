<?php

/**
 * Custom error handler to catch all the error and process them.
 */
require_once 'errorHandler.php';
/*
 * Start the session
 */
session_start();
/*
 * Load the framework constants
 */
require_once 'Library/FrameworkConstants.php';

use Library\FrameworkConstants;

FrameworkConstants::SetNamedConstants(array(
    FrameworkConstants::FrameworkConstants_Name_TestAppName => NULL
));
/**
 * Autoload defines global variables.
 */
require_once 'Library/autoload.php';

/**
 * Class name of the application to load.
 */
$placeholder = array("{{appname}}" => FrameworkConstants_AppName);
$appClassName = strtr(
        "\Applications\{{appname}}\\{{appname}}Application", $placeholder);

$errorLogger = new Library\Core\ErrorManager();
try {
  $app = new $appClassName($errorLogger);
  $logGuid = \Library\Utility\TimeLogger::StartLogInfo($app, "PageLoad => " . FrameworkConstants_BaseUrl . $app->httpRequest()->requestURI());
  $output = $app->run();
  \Library\Utility\TimeLogger::EndLog($app, $logGuid);
  if($app->httpRequest()->IsPost()) {
    echo $output;
  } else {
    exit($output);
  }
} catch (\Exception $exc) {
  $errorLogger->LogError($exc);
  die();
}