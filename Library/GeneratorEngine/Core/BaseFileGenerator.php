<?php
/**
 * Base class for creating files from a given name, description, a destination
 * path and template.
 * The derived classes (ex: ControllerFileGenerator) will perform 
 * some specific actions such as creating the basic Views and View folder, Viewmodel class
 * and so on.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package BaseFileGenerator
 */
namespace Library\GeneratorEngine\Core;
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
class BaseFileGenerator {
  protected $newFileItem;
          
}
