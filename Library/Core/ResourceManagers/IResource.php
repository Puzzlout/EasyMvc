<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package IResource
 */

namespace Library\Core\ResourceManagers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

interface IResource {
  /**
   * Method that retrieve the array of resources.
   */
  public function GetList();
    /**
   * Get the resource by group and key. See implementation the derived classes.
   * 
   * @param object $resxObj the instance of a derived class from ResxBase
   * that hold the group key to search of the array of resource. See the derived 
   * classes for more details.
   * @param string $key the resource key to find
   */
  public static function GetResource($resxObj, $key);

}
