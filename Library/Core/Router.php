<?php

namespace Library\Core;
use Library\FrameworkConstants;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class Router extends ApplicationComponent {

  public $pageUrls = array();
  public $isWsCall = false;
  public $routesXmlPath;
  protected $routes = array();
  protected $lastModified = 0; //of the routes xml file
  protected $currentRoute;
  private $routesXml;

  const NO_ROUTE = 1;

  public function __construct(Application $app) {
    parent::__construct($app);
    //$this->InitRoutesFromXml();
  }

  public function InitRoutesFromXml() {
    $this->setRoutesXmlPath(FrameworkConstants_RootDir . \Library\Enums\ApplicationFolderName::AppsFolderName . FrameworkConstants_AppName . '/Config/routes.xml');


    $routes = $this->app->user()->getAttribute(\Library\Enums\SessionKeys::UserRoutes);
    if (!$this->hasRoutesXmlChanged($this->app()->user()) && $routes) {
      $this->setRoutes($routes);
    } elseif (file_exists($this->routesXmlPath()) && ($this->hasRoutesXmlChanged($this->app()->user()) || !$this->app()->user()->getAttribute(\Library\Enums\SessionKeys::AllApplicationsRoutes))) {
      $this->LoadAvailableRoutes($this->app());
      //Store routes in session
      $this->app()->user()->setAttribute(\Library\Enums\SessionKeys::AllApplicationsRoutes, $this->routes());
    } else {
      $this->setRoutes($this->app()->user()->getAttribute(\Library\Enums\SessionKeys::AllApplicationsRoutes));
    }
  }

  public function InitRoutesFromDatabase() {
    //Find the controller classes
    //Find the view folders
  }

  /**
   * Set the route of the current request. 
   * @param \Library\Core\Route $route
   */
  public function setCurrentRoute($currentRoute) {
    $this->currentRoute = $currentRoute;
  }

  /**
   * Get the route of the current request. 
   * @param \Library\Core\Route $route
   */
  public function currentRoute() {
    return $this->currentRoute;
  }

  /**
   * Set the timestamp of the last modification of the routes.xml. 
   * @param timestamp $lastModifiedTime
   */
  public function setLastModified($lastModifiedTime) {
    $this->lastModified = $lastModifiedTime;
  }

  /**
   * Get the timestamp of the last modification of the routes.xml. 
   * @param timestamp $lastModifiedTime
   */
  public function lastModified() {
    return $this->lastModified;
  }

  /**
   * Set the path of the routes.xml. 
   * @param string $path
   */
  public function setRoutesXmlPath($path) {
    $this->routesXmlPath = $path;
  }

  /**
   * Get the path of the routes.xml. 
   * @param string $path
   */
  public function routesXmlPath() {
    return $this->routesXmlPath;
  }

  /**
   * Set the array of route objects. 
   * @param array $routes
   */
  public function setRoutes($routes) {
    $this->routes = $routes;
  }

  /**
   * Get the array of route objects. 
   * @param array $routes
   */
  public function routes() {
    return $this->routes;
  }

  /**
   * Add a route to the array of routes if not already in the array.
   * 
   * @param \Library\Core\Route $route
   */
  public function addRoute(Route $route) {
    if (!in_array($route, $this->routes)) {
      $this->routes[] = $route;
    }
  }

  /**
   * Search for a mathc route in the last of routes based on a relative url from
   * the current request.
   * 
   * @param type $url
   * Relative url of current request. 
   * @return mixed \Library\Core\Route | \RuntimeException
   * @throws \RuntimeException
   * Exception is thrown if no route is found. A 404 error page will be rendered. 
   */
  public function getRoute(Route $route, $url) {
    $constantBaseUrlSet = defined(FrameworkConstants::FrameworkConstants_BaseUrl);
    if (!$constantBaseUrlSet) {
      //todo: create error code
      throw new Exception("Named constant FrameworkConstants_BaseUrl must be set.", 0, NULL);
    } else {
      $route->Init($url);
    }
  }

  /**
   * Read the routes.xml file to build a Route object for each route found.
   * 
   * @param \Library\Core\Application $currentApp
   */
  public function LoadAvailableRoutes(Application $currentApp) {
    $xml = new \DOMDocument;
    $xml->load($this->routesXmlPath);

    $this->routesXml = $xml->getElementsByTagName('route');
    foreach ($this->routesXml as $route) {
      $vars = array();

      // Unused
      if ($route->hasAttribute('vars')) {
        $vars = explode(',', $route->getAttribute('vars'));
      }
      // Get and calculate the relative path to add to js and css files.
      $path_to_add = $this->_GetRelativePath($route->getAttribute('url'));

      $route_config = array(
          "route_xml" => $route,
          "vars" => $vars,
          "js_head" => $this->_GetJsFiles($route, "head", FrameworkConstants_BaseUrl),
          "js_html" => $this->_GetJsFiles($route, "html", FrameworkConstants_BaseUrl),
          "css" => $this->_GetCss($route, FrameworkConstants_BaseUrl, $currentApp),
          "php_modules" => $this->_LoadPhpModules($route),
          "relative_path" => $path_to_add,
          "resxfile" => $route->getAttribute('resxfile')
      );
      $this->addRoute(new Route($route_config));
    }
  }

  /**
   * Retrieve the JavaScript urls to add to the loading view or to the head element
   * 
   * @param DOMNode $route
   * The route xml node to read for the JavaScript file names. 
   * @param string $destination
   * Either: </br>
   *    - "head": to add the script tags in the head HTML element.</br>
   *    - "html": being the very end of the html page being loaded. 
   * @param string $path_to_add
   * Relative path to add to the file names read. 
   * @return string
   * A string representation of the script tag to be added to the HTML code. 
   */
  private function _GetJsFiles($route, $destination, $path_to_add) {
    $scripts = "";
    foreach ($route->getElementsByTagName('js_file') as $script) {
      if ($script->getAttribute('use') === $destination) {
        $scripts .= $script->getAttribute("type") === "external" ?
                $this->_GetExternalScriptTag($script) :
                $this->_GetInternalScriptTag($script, $path_to_add);
      } else if ($script->getAttribute('use') !== "head" && $script->getAttribute('use') !== "html") {
        //Select js files from parent route
        $parent_route = $this->getRoute(FrameworkConstants_BaseUrl . $script->getAttribute('use'));
        $scripts .= $this->_GetFilesForSibbling($parent_route, $destination, $path_to_add);
      }
    }
    return $scripts;
  }

  /**
   * Get the scripts for a sibbling route
   * 
   * Ex: 2 routes have the same scripts, then we use the route properties 
   * in the routes list to set
   * the script or css for the sibbling route. 
   * 
   * @param \Library\Core\Route $route
   * @param string $destination
   * Either: </br>
   *    - "head": to add the script tags in the head HTML element.</br>
   *    - "html": being the very end of the html page being loaded. 
   * @param string $path_to_add
   * Relative path to add to the file names read. 
   * @return string $files
   * A string representation of the script tag to be added to the HTML code. 
   */
  private function _GetFilesForSibbling(Route $route, $destination, $path_to_add) {
    $files = "";
    switch ($destination) {
      case "head":
        $files = $route->headJsScripts();
        break;
      case "html":
        $files = $route->htmlJsScripts();
        break;
      default://css
        $files = $route->cssFiles();
        break;
    }
    return $files;
  }

  /**
   * Returns the absolute file paths of PHP modules to load per route. 
   * There are 2 cases:<ul>
   *  <li>with the shared attribute, shared modules will be found in
   *  in "Applications/YourApp/Views/Modules"</li>
   *  <li>dedicated modules (to the module specified in the route) will be found
   *  in "Application/YourApp/Views/CurrentRoute/Modules".</li>
   * 
   * @param DOMNode $route
   * @return array
   * The list of PHP modules available for the current route. 
   */
  public function _LoadPhpModules($route) {
    $modules = array();
    foreach ($route->getElementsByTagName('php_module') as $module) {
      if ($module->getAttribute('shared')) {
        $modules[$module->getAttribute('key')] = FrameworkConstants_RootDir . \Library\Enums\ApplicationFolderName::AppsFolderName
                . $this->app->name()
                . rtrim(\Library\Enums\ApplicationFolderName::ViewsFolderName, '/') . \Library\Enums\ApplicationFolderName::ModulesFolderName
                . $module->getAttribute('file_name');
      } else {
        $modules[$module->getAttribute('key')] = FrameworkConstants_RootDir . \Library\Enums\ApplicationFolderName::AppsFolderName
                . $this->app->name()
                . \Library\Enums\ApplicationFolderName::ViewsFolderName . $route->getAttribute('module') . \Library\Enums\ApplicationFolderName::ModulesFolderName
                . $module->getAttribute('file_name');
      }
    }
    return $modules;
  }

  /**
   * Calculate the relative path to use for the css and js files declaration in HTML views
   * 
   * @param DOMNode $route
   * @return string
   */
  private function _GetRelativePath($route) {
    $route = rtrim($route, '/');
    $relative_path_count = explode("/", $route);
    $relative_path = "";
    for ($i = 1; $i < count($relative_path_count); $i++) {
      $relative_path .= "../";
    }
    return $relative_path;
  }

  public function hasRoutesXmlChanged(\Library\Core\User $user) {
    if (file_exists($this->routesXmlPath)) {
      $currentLastModifiedTime = filemtime($this->routesXmlPath);

      if (!$user->getAttribute(\Library\Enums\SessionKeys::SessionRoutesXmlLastModified)) {
        $user->setAttribute(\Library\Enums\SessionKeys::SessionRoutesXmlLastModified, $currentLastModifiedTime);
        return FALSE;
      } else {
        $result = $currentLastModifiedTime > $user->getAttribute(\Library\Enums\SessionKeys::SessionRoutesXmlLastModified);
        if ($result) {
          $user->setAttribute(\Library\Enums\SessionKeys::SessionRoutesXmlLastModified, $currentLastModifiedTime);
        }
        return $result;
      }
    }
  }

  private function _GetExternalScriptTag($script) {
    return '<script type="application/javascript" src="' .
            $script->getAttribute('value') .
            '"></script>';
  }

  private function _GetInternalScriptTag($script, $path_to_add) {
    return '<script type="application/javascript" src="' .
            $path_to_add .
            $script->getAttribute('value') .
            "?v" . FrameworkConstants_Version .
            '"></script>';
  }

  private function _GetInternalCssTag($css_file, $path_to_add) {
    return '<link rel="stylesheet" type="text/css" href="' .
            $path_to_add .
            $css_file->getAttribute('value') .
            "?v" . FrameworkConstants_Version .
            '"/>';
  }

  private function _GetCss($route, $path_to_add, $app) {
    if ($app->config()->get(\Library\Enums\AppSettingKeys::ApplicationMode) == "DEV") {
      return $this->_LoadCssFiles($route, $path_to_add);
    } elseif ($app->config()->get(\Library\Enums\AppSettingKeys::ApplicationMode) == "RELEASE") {
      return $this->_LoadCssFilesIntoOne($route, $path_to_add, $app);
    }
  }

  /**
   * Returns the css files urls to add to the loading view
   * 
   * @param DoMNode $route
   */
  private function _LoadCssFiles($route, $path_to_add) {
    $css_files = "";
    foreach ($route->getElementsByTagName('css_file') as $css_file) {
      if ($css_file->getAttribute("use") !== "") {
        $parent_route = $this->getRoute(FrameworkConstants_BaseUrl . $css_file->getAttribute('use'));
        $css_files .= $this->_GetFilesForSibbling($parent_route, "css", $path_to_add);
      } else {
        $css_files .= $this->_GetInternalCssTag($css_file, $path_to_add);
      }
    }
    return $css_files;
  }

  private function _LoadCssFilesIntoOne($route, $path_to_add, $app) {
    //  1. Check if the single Css file exists for the route in the app
    //  2. Check if the single Css file exists in the directory storing each
    //    file per route
    //  3. Otherwise, create it from the list of css files from the current route
    //    and the list in third_party_library_files.xml and then store the created
    //    file to the proper location.
  }

}
