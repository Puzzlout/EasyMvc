<?php

/**
 * Version number global variable definition
 * It is used to allow automatic client refresh of the JavaScript and CSS files.
 */
define('__VERSION_NUMBER__', '1.0.0');

/**
 * Autoload defines global variables.
 */
require '../Library/autoload.php';

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

$app = new $appClassName();//$appClassName is declared in Library/autoload.php
try {
  if (
          strstr($app->httpRequest->requestURI(), Library\Enums\UrlKeys::LoginUrl) !== FALSE ||
          strstr($app->httpRequest->requestURI(), Library\Enums\UrlKeys::AuthenticationUrl) !== FALSE ||
          $app->user->isConnected()) {
    $app->run();
  } else {//Otherwise, redirect to default page set in Applications/YourApp/Config/appsettings.xml
    header('Location: ' . __BASEURL__ . $app->config()->get(Library\Enums\AppSettingKeys::DefaultPage));
    die();
  }
} catch (\Exception $exc) {
  $errorLogger = new Library\Core\ErrorManager($app, $exc);
  $errorLogger->LogError($exc);
}