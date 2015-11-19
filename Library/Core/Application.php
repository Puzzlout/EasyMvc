<?php

namespace Library\Core;

use Library\Enums;
use Library\GeneratorEngine\Core\BaseClassGenerator;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class Application extends ApplicationBase {

  public function __construct(ErrorManager $errorManager) {
    $this->ResourceManager = new ResourceManagers\ResourceBase($this);
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
  }

  /**
   * Retrieve the cultures from the database and transform the object list into
   * an associative array of following structure:
   * 
   * array(
   *    "xx-XX" => (array of F_culture_extension object),
   *    "yy-YY" => (array of F_culture_extension object),
   *    ...
   * )
   * 
   * @return associative array the array of culture
   */
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
                [$cultureObj->F_culture_language() . '-' . $cultureObj->F_culture_region()] = \Library\Helpers\CommonHelper::CleanPrefixedkeyInAssocArray((array) $cultureObj);
      }
    }
    return $cultureAssocArray[\Library\BO\F_culture_extension::FullArrayCultureKey];
  }

  /**
   * Retrieve the Controller instance that matches the Route instance.
   * @return \Library\Controllers\BaseController the Controller object
   */
  public function getController() {
    $this->router->setCurrentRoute();
    $controllerObject = $this->GetControllerObject($this->router->currentRoute());
    $this->controller = $controllerObject;
    return $controllerObject;
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
    $controllerClass = "\Library\Controllers\ErrorController";
    if (array_key_exists($controllerName, $FrameworkControllers)) {
      $frameworkControllerFolderPath = \Library\Enums\NameSpaceName::LibFolderName
              . \Library\Enums\NameSpaceName::LibControllersFolderName;
      $controllerClass = $frameworkControllerFolderPath . $controllerName;
      $this->router()->isWsCall = TRUE;
    } else if (array_key_exists($controllerName, $ApplicationControllers)) {
      $applicationControllerFolderPath = \Library\Enums\NameSpaceName::AppsFolderName . "\\"
              . $this->name
              . \Library\Enums\NameSpaceName::AppsControllersFolderName;
      $controllerClass = $applicationControllerFolderPath . $controllerName;
    } else {
      error_log("The controller requested '$controllerClass' doesn't exist.");
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
