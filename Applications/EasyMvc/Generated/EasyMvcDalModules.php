<?php
/**
 * Lists the constants for application dal module classes for autocompletion and easy coding.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package EasyMvcDalModules
 */

namespace Applications\EasyMvc\Generated;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class EasyMvcDalModules {
  const LOGINDAL = 'LoginDal';  const _TEMPLATEDAL = '_TemplateDal';  public static function GetList() {    return array(      self::LOGINDAL => 'LoginDal',      self::_TEMPLATEDAL => '_TemplateDal',    );  }}