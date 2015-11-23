<?php

/**
 * Class to manage the Web IDE.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package WebIdeController
 */

namespace Library\Controllers;

use Library\GeneratorEngine\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class WebIdeController extends \Library\Controllers\BaseController {

  public function CreateFile() {
    $Vm = new \Library\ViewModels\WebIdeVm($this->app);
    $Vm->SolutionPathListArray = 
            \Library\Core\DirectoryManager\DirectorySearchWithRegex::Init()->RecursiveScanOf(
                    FrameworkConstants_RootDir,
                    \Library\Enums\CommonRegexes::DirectoryExcludePattern);
    var_dump($Vm->SolutionPathListArray);
    $this->vm = $Vm;
  }
  
  public function ProcessFileCreationRequest() {
    
    $this->vm = new \Library\ViewModels\BaseAjaxVm($this->app);
  }

}
