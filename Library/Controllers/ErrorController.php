<?php

/**
 * Controller to display the error result to the user.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ErrorController
 */

namespace Library\Controllers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ErrorController extends \Library\Controllers\BaseController {

  public function ControllerNotFound() {
    $this->viewModel->errorVm->errorId(0);
    $this->viewModel->errorVm->errorMessage("Controller Not Found");
  }

  public function Http404() {
    $this->viewModel = new \Library\ViewModels\HttpErrorVm($this->app());
    $this->viewModel->errorVm->errorId(404);
    $this->viewModel->errorVm->errorMessage("Page not found");
  }

}
