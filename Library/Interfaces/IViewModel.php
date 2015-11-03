<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package IViewModel
 */

namespace Library\Interfaces;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

interface IViewModel {
  /**
   * Get the resources for a given ViewModel.
   * @return array The resources for the view model.
   */
  public function GetResources();
  
  /**
   * Copy an Vm  Object into a new instance.
   */
  public static function Copy($VmObject);
}
