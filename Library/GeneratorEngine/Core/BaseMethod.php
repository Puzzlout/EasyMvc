<?php
/**
 * Base class for class methods generation.
 * A method is made of:
 *    - an accessor: private, public, protected
 *    - a static keyword
 *    - a name: as descriptive as possible!
 *    - a set of parameters: max. 5! If you find yourself having more than 5, consider creating a class containing all those parameters.
 *    - a return value type: PHP 5.6 and below don't handle return type hinting but PHP 7.0 will so why not anticipate?
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package BaseMethod
 */
namespace Library\GeneratorEngine\Core;
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
class BaseMethod {

}
