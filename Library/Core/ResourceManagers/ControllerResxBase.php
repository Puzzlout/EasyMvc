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

class ControllerResxBase extends ResourceLoaderBase implements IResource {

  /**
   * Method that retrieve the array of resources.
   */
  public function GetList() {
    throw new \Library\Exceptions\NotImplementedException();
  }

  /**
   * Get the resource by moudle, action and key.
   * 
   * @param string $key the resource key to find
   */
  public function GetResource($key) {
    $resourceFileName = 
            "\\Applications\\" . 
            FrameworkConstants_AppName . 
            "\\Resources\\Controller\\" .
            ucfirst($this->ModuleValue) . "Resx_" . $this->CultureValue;
    $resourceFile = new $resourceFileName();
    $resources= $resourceFile->GetList();
    return array_key_exists($key, $resources) ?
            $resources[$this->ActionValue][$key] :
            "Missing resource [$this->ActionValue][$key]";
  }

}
