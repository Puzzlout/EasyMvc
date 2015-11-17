<?php

/**
 * Base class for handling the controller resources.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ControllerResxBase
 */

namespace Library\Core\ResourceManagers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ControllerResxBase extends ResourceBase implements \Library\Interfaces\IResource {

  /**
   * Method that retrieve the array of resources.
   * @return array the array of ressources
   */
  public function GetList() {
    $resourceFileName = "\\Applications\\" .
            FrameworkConstants_AppName .
            "\\Resources\\Controller\\" .
            ucfirst($this->ModuleValue) . "Resx_" . $this->CultureValue;
    $resourceFile = new $resourceFileName();
    return $resourceFile->GetList();
  }

  /**
   * Get the resource by module, action and key.
   * 
   * @param string $key the resource key to find
   * @return string the resource value
   * @todo create a error code for exception
   */
  public function GetValue($key) {
    $resources = $this->GetList();
    $actionLower = strtolower($this->ActionValue);
    $keyLower = strtolower($key);
    $actionExists = array_key_exists($actionLower, $resources);
    $keyExist = $actionExists ?
            array_key_exists($keyLower, $resources[$actionLower]) :
            FALSE;
    if ($keyExist) {
    return $resources[$actionLower][$keyLower][\Library\BO\F_controller_resource::F_CONTROLLER_RESOURCE_VALUE];
    } else if (!$actionExists) {
//      throw new \Library\Exceptions\ResourceNotFoundException(
//      "The resource value doesn't exist for Module => " . $this->ModuleValue . " and Action => " . $this->ActionValue, 0, NULL);
      return "???";
    } else {
//      throw new \Library\Exceptions\ResourceNotFoundException(
//      "The resource value doesn't exist for Module => " . $this->ModuleValue . ", Action => " . $this->ActionValue . " and Key => " . $key, 0, NULL);
      return "???";
    }
  }

  /**
   * Get the resource comment by module, action and key.
   * 
   * @param string $key the resource key to find
   * @return string the resource comment
   * @todo create a error code for exception
   */
  public function GetComment($key) {
    $resources = $this->GetList();
    $actionExists = array_key_exists($this->ActionValue, $resources);
    $keyExist = $actionExists ?
            array_key_exists($key, $resources[$this->ActionValue]) :
            FALSE;
    if ($keyExist) {
      return $resources[$this->ActionValue][$key][\Library\BO\F_controller_resource::F_CONTROLLER_RESOURCE_COMMENT];
    } else if (!$actionExists) {
      throw new \Library\Exceptions\ResourceNotFoundException(
      "The resource comment doesn't exist for Module => " . $this->ModuleValue . " and Action => " . $this->ActionValue, 0, NULL);
    } else {
      throw new \Library\Exceptions\ResourceNotFoundException(
      "The resource comment doesn't exist for Module => " . $this->ModuleValue . ", Action => " . $this->ActionValue . " and Key => " . $key, 0, NULL);
    }
  }

}
