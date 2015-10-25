<?php

/**
 * Provides a set of functions loading the resources from xml files into an array structure. 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package ResourceLoaderBase
 */

namespace Library\Core\ResourceManagers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ResourceLoaderBase extends ResourceBase {
  public function GetList() {
    throw new \Library\Exceptions\NotImplementedException();
  }
  
  public function GetResource($resxObj, $key) {
    throw new \Library\Exceptions\NotImplementedException();
  }
  
}
