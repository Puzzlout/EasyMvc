<?php

/**
 * Provides an interface to manage AjaxBaseViewModel
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package IJsonViewModel
 */

namespace Library\Interfaces;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

interface IJsonViewModel {
  /**
   * Transform the Vm object given to a JSON object.
   * @return JSON The JSON object for the view model.
   */
  //public function EncodeToJson($vm);
}
