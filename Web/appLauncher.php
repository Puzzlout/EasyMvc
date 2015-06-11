<?php

define('__VERSION_NUMBER__', '1.0.0');
require '../Library/autoload.php';
set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
  // error was suppressed with the @-operator
  if (0 === error_reporting()) {
    return false;
  }

  throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

ini_set("display_errors", 1);
$app = new $appClassName();
try {
  if (
          strstr($app->HttpRequest->requestURI(), Library\Enums\UrlKeys::LoginUrl) !== FALSE ||
          strstr($app->HttpRequest->requestURI(), Library\Enums\UrlKeys::AuthenticationUrl) !== FALSE ||
          $app->user->isConnected()) {
    $app->run();
  } else {//Otherwise, redirect to default page set in Applications/YourApp/Config/appsettings.xml
    header('Location: ' . __BASEURL__ . $app->config()->get(Library\Enums\AppSettingKeys::DefaultPage));
    die();
  }
} catch (Exception $exc) {
  $errorLogger = new Library\Core\ErrorManager($app);
  $errorLogger->LogError($exc);
}