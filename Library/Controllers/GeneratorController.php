<?php

/**
 * Class to generate php classes.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package GeneratorController
 */

namespace Library\Controllers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class GeneratorController extends \Library\Controllers\BaseController {

  public function Index() {
    $this->vm = new \Library\ViewModels\GeneratorVm($this->app);
    
  }
  public function BuildDao() {
    $generator = new \Library\GeneratorEngine\Core\GeneratorManager($this->app());
    $generator->GenerateDaoClasses();
    $this->vm = new \Library\ViewModels\GeneratorVm($this->app);
  }

  public function BuildResources() {
    $generator = new \Library\GeneratorEngine\Core\GeneratorManager($this->app());
    $generator->GenerateResourceArrays();
    $this->vm = new \Library\ViewModels\GeneratorVm($this->app);
  }

  public function BuildControllerConstantsClass() {
    $vm = new \Library\ViewModels\GeneratorVm($this->app);
    $generator = new \Library\GeneratorEngine\Core\GeneratorManager($this->app());
    $vm->filesGenerated = $generator->GenerateControllerConstantsClass();
    $this->vm = $vm;
  }

  public function BuildDalModuleConstantsClass() {
    $vm = new \Library\ViewModels\GeneratorVm($this->app);
    $generator = new \Library\GeneratorEngine\Core\GeneratorManager($this->app());
    $vm->filesGenerated = $generator->GenerateDalModuleConstantsClass();
    $this->vm = $vm;
  }

  public function BuildViewNameConstantsClass() {
    $generator = new \Library\GeneratorEngine\Core\GeneratorManager($this->app());
    $generator->GenerateResourceArrays();
    $this->vm = new \Library\ViewModels\GeneratorVm($this->app);
  }

}
