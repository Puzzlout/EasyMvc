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
   * Get the Resource Object for a given ViewModel.
   * @return Object The resource object for the view model.
   */
  public function GetResourceObject();
  
  /**
   * Get the resource for the given key.
   * @param string $key
   */
  public function ResxFor($key);
}
