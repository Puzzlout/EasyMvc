<?php

/**
 * View model to use for all code generation.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package GeneratorVm
 */

namespace Library\ViewModels;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class GeneratorVm extends BaseVm {
  public $links = array();
}
