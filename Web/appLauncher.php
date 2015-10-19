<?php

/**
 * Custom error handler to catch all the error and process them.
 */
require_once '../errorHandler.php';
/*
 * Start the session
 */
session_start();
/*
 * Load the framework constants
 */
require_once '../Library/FrameworkConstants.php';
use Library\FrameworkConstants;
FrameworkConstants::SetNamedConstants(array(
    FrameworkConstants::FrameworkConstants_Name_TestAppName => NULL
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

$errorLogger = new Library\Core\ErrorManager();
try {
  $app = new $appClassName($errorLogger);
  $logId = \Library\Utility\TimeLogger::StartLog($app, "PageLoad.".$app->httpRequest()->requestURI(), Library\BO\F_log_extension::LEVEL_INFO);
  $app->run();
  \Library\Utility\TimeLogger::EndLog($app, $logId, Library\BO\F_log_extension::LEVEL_INFO);
} catch (\Exception $exc) {
  $errorLogger->LogError($exc);
  die();
}