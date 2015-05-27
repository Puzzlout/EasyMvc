<?php

namespace Library\Core;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

abstract class Application {

  public $HttpRequest;
  protected $httpResponse;
  public $name;
  public $locale;
  public $localeDefault;
  public $pageTitle;
  public $pageUrls;
  public $logoImageUrl;
  public $globalResources;
  public $relative_path;
  public $user;
  public $config;
  public $i8n;
  public $imageUtil;
  public $jsManager;
  public $cssManager;

  public function __construct() {
    $this->HttpRequest = new HttpRequest($this);
    $this->httpResponse = new HttpResponse($this);

    $this->router = new Router($this);
    $this->user = new User($this);
    $this->config = new Config($this);
    $this->context = new Context($this);
    $this->i8n = new Globalization($this);
    $this->imageUtil = new \Library\Utility\ImageUtility($this);
    $this->locale = $this->HttpRequest->initLanguage($this, "browser");
    $this->name = '';
//    $this->jsManager = new Core\Utility\JavascriptManager($this);
//    $this->cssManager = new Core\Utility\CssManager($this);
  }

  public function initConfig() {
    
  }

  public function getController() {
    $this->router()->setRoutesXmlPath(__ROOT__ . \Library\Enums\ApplicationFolderName::AppsFolderName . $this->name() . '/Config/routes.xml');

    if ($this->router()->hasRoutesXmlChanged($this->user()) || !$this->user->keyExistInSession(\Library\Enums\SessionKeys::SessionRoutes)) {
      $this->router->LoadAvailableRoutes($this);
      //Store routes in session
      $this->user->setAttribute(\Library\Enums\SessionKeys::SessionRoutes, $this->router()->routes());
    } else {
      $this->router()->setRoutes($this->user->getAttribute(\Library\Enums\SessionKeys::SessionRoutes));
    }
    $this->router()->setSelectedRoute($this->FindRouteMatch());
    $this->relative_path = $this->router()->selectedRoute()->relative_path;
    $this->globalResources["js_files_head"] = $this->router()->selectedRoute()->headJsScripts();
    $this->globalResources["js_files_html"] = $this->router()->selectedRoute()->htmlJsScripts();
    $this->globalResources["css_files"] = $this->router()->selectedRoute()->cssFiles();

    if (preg_match("`.*ws$`",$this->router()->selectedRoute()->type())) {//is the route used for AJAX calls?
      $this->router()->isWsCall = true;
    }
    // On ajoute les variables de l'URL au tableau $_GET.
    $_GET = array_merge($_GET, $this->router()->selectedRoute()->vars());

    $controllerClass = $this->BuildControllerClass($this->router()->selectedRoute());
    if (!file_exists(__ROOT__ . str_replace('\\', '/', $controllerClass) . \Library\Enums\FileNameConst::Extension)) {
      $error = new \Library\BO\Error(
              \Library\Enums\ErrorCodes::ControllerNotExist, 
              "controller", 
              "Controller not found",
              "The controller ". $controllerClass . " doesn't exist.");
      $this->httpResponse->displayError($error);
    }
    return new $controllerClass($this, $this->router()->selectedRoute()->module(), $this->router()->selectedRoute()->action(), $this->router()->selectedRoute()->resxfile());
  }

  abstract public function run();

  public function HttpRequest() {
    return $this->HttpRequest;
  }

  public function httpResponse() {
    return $this->httpResponse;
  }

  public function user() {
    return $this->user;
  }

  public function config() {
    return $this->config;
  }

  public function context() {
    return $this->context;
  }

  public function i8n() {
    return $this->i8n;
  }

  public function pageUrls() {
    return array();
  }

  public function router() {
    return $this->router;
  }

  public function name() {
    return $this->name;
  }

  private function FindRouteMatch() {
    try {
      // On récupère la route correspondante à l'URL.
      return $this->router->getRoute($this->HttpRequest->requestURI());
    } catch (\RuntimeException $e) {
      if ($e->getCode() == \Library\Core\Router::NO_ROUTE) {
        // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
        $error = new \Library\BO\Error(
                \Library\Enums\ErrorCodes::PageNotFound,
                "routing",
                "Page not found",
                "The route " . $this->HttpRequest->requestURI() . " is not found."
                );
        $this->httpResponse->displayError($error);
      }
    }
  }
  
  /**
   * Build the string of the controller class to load for the current route
   * 
   * @param \Library\Core\Route $route : the current route
   * @return string : the controller class name w/ namespace
   */
  private function BuildControllerClass(\Library\Core\Route $route) {
    if (preg_match("`^lib.*$`", $route->type())) {
//AJAX request for the Framework
      return \Library\Enums\NameSpaceName::LibFolderName 
        . \Library\Enums\NameSpaceName::LibControllersFolderName
        . $route->module()
        . \Library\Enums\FileNameConst::ControllerSuffix;
    } else {
//AJAX request for the Application
      return \Library\Enums\NameSpaceName::AppsFolderName
        . \Library\Enums\NameSpaceName::AppsControllersFolderName
        . $route->module()
        . \Library\Enums\FileNameConst::ControllerSuffix;
    }
  }

}