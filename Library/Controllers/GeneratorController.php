<?php
/**
 * Class to generate php classes.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package GeneratorController
 */

namespace Library\Controllers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class GeneratorController extends \Library\Controllers\BaseController {

  public function BuildDaoClasses() {
    $generator = new \Library\Dal\Generator\GeneratorManager($this->app());
    $generator->GenerateDaoClasses();
  }

}
