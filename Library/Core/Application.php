<?php

namespace Library\Core;

use Library\Enums;
use Library\GeneratorEngine\BaseClassGenerator;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class Application {

  const CONTROLLER_NAME_PREFIX = "F_";
  const CULTURES_ARRAY_KEY = "application_cultures";

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
  public $cultures = array();

  public function __construct(ErrorManager $errorManager) {
    $this->error = $errorManager;
    $this->httpRequest = new HttpRequest($this);
    $this->httpResponse = new HttpResponse($this);
    $this->user = new User($this);
    $this->config = new Config($this);
    $this->dal = new \Library\Dal\Managers('PDO', $this);
    $this->context = new Context($this);
    $this->cultures = $this->GetCultureArray();
    $this->i8n = new Globalization($this);
    $this->imageUtil = new \Library\Utility\ImageUtility($this);

    $this->router = new Router($this);
    $this->locale = $this->httpRequest->initLanguage($this, "browser");
    $this->name = '';
    $this->auth = new \Library\Security\AuthenticationManager($this);
    $this->toolTip = new PopUpResourceManager($this);
    $this->security = new \Library\Security\Protect($this->config);
//    $this->jsManager = new Core\Utility\JavascriptManager($this);
//    $this->cssManager = new Core\Utility\CssManager($this);
  }

  public function GetCultureArray() {
    $dal = $this->dal->getDalInstance();
    $dbFilters = new \Library\Dal\DbQueryFilters();
    $dbFilters->setOrderByFilters(array(\Library\BO\F_culture_extension::F_CULTURE_ID));
    $cultureObjects = $dal->selectMany(new \Library\BO\F_culture_extension(), $dbFilters);
    $cultureAssocArray = array(\Library\BO\F_culture_extension::FullArrayCultureKey => null);
    if (count($cultureObjects) > 0) {
      foreach ($cultureObjects as $cultureObj) {
        $cultureAssocArray
            [\Library\BO\F_culture_extension::FullArrayCultureKey]
            [\Library\BO\F_culture_extension::SingleCultureArrayKey . $cultureObj->f_culture_id()] = 
            \Library\Helpers\CommonHelper::CleanPrefixedkeyInAssocArray((array) $cultureObj);
      }
    }
    return $cultureAssocArray;
  }

  public function initConfig() {
    
  }

  public function getController() {

    $this->router->setCurrentRoute($this->FindRouteMatch());

    $controllerObject = $this->GetControllerObject($this->router->currentRoute());
//    if ($controllerObject instanceof \Library\Controllers\ErrorController) {
//      $this->httpResponse->displayError(new \Library\BO\Error);
//    }
    return $controllerObject;
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
    $FrameworkControllersListClass = "\Library\Generated\FrameworkControllers";
    $ApplicationControllersListClass = "\Applications\\" .
        FrameworkConstants_AppName .
        "\Generated\\" .
        FrameworkConstants_AppName . "Controllers";

    $controllerClassName = $this->FindControllerClassName(
        $controllerName, $FrameworkControllersListClass, $ApplicationControllersListClass, $route
    );
    return $this->InstanciateController($controllerClassName, $route);
  }

  /**
   * Find the controller class name to instanciate.
   * 
   * @param string $controllerName : the controller to find
   * @param string $FrameworkControllersListClass : class name to the list of framework controllers list
   * @param string $ApplicationControllersListClass : class name to the list of current application controllers list
   * @param \Library\Core\Route $route : the current route
   */
  public function FindControllerClassName($controllerName, $FrameworkControllersListClass, $ApplicationControllersListClass, \Library\Core\Route $route) {
    $FrameworkControllers = $FrameworkControllersListClass::GetList();
    $ApplicationControllers = $ApplicationControllersListClass::GetList();

    if (array_key_exists($controllerName . BaseClassGenerator::Key, $FrameworkControllers)) {
      $frameworkControllerFolderPath = \Library\Enums\NameSpaceName::LibFolderName
          . \Library\Enums\NameSpaceName::LibControllersFolderName;
      $controllerClass = $frameworkControllerFolderPath . $controllerName;
      $this->router()->isWsCall = TRUE;
    } else if (array_key_exists($controllerName . BaseClassGenerator::Key, $ApplicationControllers)) {
      $applicationControllerFolderPath = \Library\Enums\NameSpaceName::AppsFolderName . "\\"
          . $this->name
          . \Library\Enums\NameSpaceName::AppsControllersFolderName;
      $controllerClass = $applicationControllerFolderPath . $controllerName;
    } else {
      error_log("The controller requested '$controllerClass' doesn't exist.");
      $controllerClass = "\Library\Controllers\ErrorController";
      $route->setModule("Error");
      $route->setAction("ControllerNotFound");
    }
    return $controllerClass;
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
      $this->error->LogError($exc);
      throw new \Exception("Controller not loaded", Enums\ErrorCodes\FrameworkControllerConstants::ControllerNotLoadedValue, $exc);
    }
  }

}
