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
  const LoginDal = 'LoginDal';  const _TemplateDal = '_TemplateDal';  public static function GetList() {    return array(      self::LoginDal => 'LoginDal',      self::_TemplateDal => '_TemplateDal',    );  }}