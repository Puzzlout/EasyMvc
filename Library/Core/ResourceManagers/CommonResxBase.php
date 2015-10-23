<?php

/**
 * Base class for handling the common resources.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package CommonResxBase
 */

namespace Library\Core\ResourceManagers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class CommonResxBase extends ResxBase {

  /**
   * Method that retrieve the array of resources.
   */
  public function GetList();

  /**
   * Get the resource by group and key.
   * 
   * @param object $resxObj the instance of a derived class from CommonResxBase
   * that hold the group key to search of the array of resource.
   * @param string $key the resource key to find
   */
  public static function GetResource($resxObj, $key) {
    
  }

}
