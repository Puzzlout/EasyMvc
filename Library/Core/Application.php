<?php

namespace Library\Core;

use Library\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class Application {

  const CONTROLLER_NAME_PREFIX = "F_";

  public $HttpRequest;
  protected $httpResponse;
  public $name;
  public $locale;
  public $localeDefault;
  public $pageTitle;
  public $logoImageUrl;
  public $globalResources;
  public $relative_path;
  public $user;
  public $config;
  public $i8n;
  public $imageUtil;
  public $jsManager;
  public $cssManager;
  public $auth;
  public $dal;
  public $toolTip;
  protected $security;
  public $error;

  public function __construct(ErrorManager $errorManager) {
    $this->error = $errorManager;
    $this->httpRequest = new HttpRequest($this);
    $this->httpResponse = new HttpResponse($this);
    $this->user = new User($this);
    $this->config = new Config($this);
    $this->context = new Context($this);
    $this->i8n = new Globalization($this);
    $this->imageUtil = new \Library\Utility\ImageUtility($this);

    $this->router = new Router($this);
    $this->locale = $this->httpRequest->initLanguage($this, "browser");
    $this->name = '';
    $this->auth = new \Library\Security\AuthenticationManager($this);
    $this->dal = new \Library\Dal\Managers('PDO', $this);
    $this->toolTip = new PopUpResourceManager($this);
    $this->security = new \Library\Security\Protect($this->config);
//    $this->jsManager = new Core\Utility\JavascriptManager($this);
//    $this->cssManager = new Core\Utility\CssManager($this);
  }

  public function initConfig() {
    
  }

  public function getController() {

    $this->router->setCurrentRoute($this->FindRouteMatch());

    $controllerObject = $this->GetControllerObject($this->router->currentRoute());
    if (strcasecmp($controllerObject, Enums\ErrorCodes\FrameworkControllerConstants::ControllerNotFoundValue) === 0) {
      $error = new \Library\BO\Error(
              \Library\Enums\ErrorCode::ControllerNotExist, Enums\ErrorOrigin::Library, "Controller not found", "The controller " . $controllerClass . " doesn't exist.");
      $this->httpResponse->displayError($error);
    }
    return new $controllerObject;
  }

  abstract public function run();

  public function HttpRequest() {
    return $this->httpRequest;
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

  public function router() {
    return $this->router;
  }

  public function name() {
    return $this->name;
  }

  public function css() {
    return $this->cssManager;
  }

  public function js() {
    return $this->jsManager;
  }

  public function auth() {
    return $this->auth;
  }

  public function dal() {
    return $this->dal;
  }

  public function toolTip() {
    return $this->toolTip;
  }

  public function security() {
    return $this->security;
  }

  private function FindRouteMatch() {
    try {
      $route = new Route();
      $this->router->getRoute($route, $this->httpRequest->requestURI());
      return $route;
    } catch (\RuntimeException $e) {
      if ($e->getCode() == \Library\Core\Router::NO_ROUTE) {
// Si aucune route ne correspond, c'est que la page demandée n'existe pas.
        $error = new \Library\BO\Error(
                \Library\Enums\ErrorCode::PageNotFound, "routing", "Page not found", "The route " . $this->httpRequest->requestURI() . " is not found."
        );
        $this->httpResponse->displayError($error);
      }
    }
  }

  /**
   * Builds the controller object from a route object.
   * 
   * @param \Library\Core\Route $route : the current route
   * @return \Library\Controllers\BaseController
   */
  private function GetControllerObject(\Library\Core\Route $route) {
    $controllerName = $this->BuildControllerName($route);
    $controllerClass = "";
    if (preg_match("`^" . self::CONTROLLER_NAME_PREFIX . "*$`", $controllerName)) {
      $frameworkControllerFolderPath = \Library\Enums\NameSpaceName::LibFolderName
              . \Library\Enums\NameSpaceName::LibControllersFolderName;
      $controllerClass = $frameworkControllerFolderPath . $controllerName;
    } else {
      $applicationControllerFolderPath = \Library\Enums\NameSpaceName::AppsFolderName . "\\"
              . $this->name
              . \Library\Enums\NameSpaceName::AppsControllersFolderName;
      $controllerClass = $applicationControllerFolderPath . $controllerName;
    }
    return $this->InstanciateController($controllerClass, $route);
  }
  
  /**
   * Builds the controller name.
   * 
   * @param \Library\Core\Route $route
   * @return string
   */
  private function BuildControllerName(Route $route) {
    return ucfirst($route->module()) . Enums\FileNameConst::ControllerSuffix;
  }

  /**
   * Instanciate a controller from a name.
   * 
   * @param string $controllerClass
   * @param \Library\Core\Route $route
   * @return \Library\Controllers\BaseController
   * @throws \Exception : when the controller class can't be instanciated.
   */
  protected function InstanciateController($controllerClass, Route $route) {
    try {
      return new $controllerClass($this, $route->module(), $route->action());
    } catch (\Exception $exc) {
      throw new \Exception("Controller not found", Enums\ErrorCodes\FrameworkControllerConstants::ControllerNotFoundValue, $exc);
    }
  }
}
