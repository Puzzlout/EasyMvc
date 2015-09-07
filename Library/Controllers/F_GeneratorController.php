<?php

/**
 *
 * @package		Easy MVC Framework
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * GeneratorController controller Class
 *
 * @package		Library
 * @category	Controllers
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Controllers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class F_GeneratorController extends \Library\Controllers\BaseController {

  public function BuildDaoClasses() {
    $generator = new \Library\Dal\Generator\GeneratorManager($this->app());
    $generator->GenerateDaoClasses();
  }

}
