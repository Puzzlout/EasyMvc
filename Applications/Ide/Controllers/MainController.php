<?php

/**
 * Class to manage the Web IDE.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package MainController
 */

namespace Applications\Ide\Controllers;

use Applications\Ide\ViewModels\MainVm;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class MainController extends \Library\Controllers\BaseController {

  public function CreateFile() {
    $this->viewModel = new MainVm($this->app);
  }
}
