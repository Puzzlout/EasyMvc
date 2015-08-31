<?php

/**
 * Route class
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package Route
 */

namespace Library\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class Route {

  protected $action;
  protected $module;
  protected $url;

  const StartIndexNoVirtualPath = 1;
  const StartIndexWithVirtualPath = 2;

  public function __construct() {
    
  }

  /**
   * Sets the url, module and action of the current route.
   * @param string $url
   */
  public function Init($url) {
    $urlParts = explode("/", $url);

    $baseUrlConstainsVirtualPath = !(strcasecmp("/", FrameworkConstants_BaseUrl) === 0);
    $startIndex = $baseUrlConstainsVirtualPath ? self::StartIndexWithVirtualPath : self::StartIndexNoVirtualPath;

    $this->setUrl($url);
    $this->setModule($urlParts[$startIndex]);
    $this->setAction($urlParts[$startIndex + 1]);
  }

  /**
   * Gets url of the route.
   * @return string
   */
  public function url() {
    return $this->url;
  }

  /**
   * Gets the action of the route.
   * @return string
   */
  public function action() {
    return $this->action;
  }

  /**
   * Gets the module of the route.
   * @return string
   */
  public function module() {
    return $this->module;
  }

  /**
   * Sets url of the route.
   * @return string
   */
  public function setUrl($url) {
    if (is_string($url)) {
      $this->url = FrameworkConstants_BaseUrl . $url;
    }
  }

  /**
   * Sets the action of the route.
   * @return string
   */
  public function setAction($action) {
    if (empty($action)) {
      throw new \Exception("Action cannot be empty", 0, NULL); //todo: create error code
    } else if (!is_string($action)) {
      throw new \Exception("Action must be a string", 0, NULL); //todo: create error code
    } else {
      $this->action = $action;
    }
  }

  /**
   * Sets the module of the route.
   * @return string
   */
  public function setModule($module) {
    if (empty($module)) {
      throw new \Exception("Module cannot be empty", 0, NULL); //todo: create error code
    } else if (!is_string($module)) {
      throw new \Exception("Module must be a string", 0, NULL); //todo: create error code
    } else {
      $this->module = $module;
    }
  }

}
