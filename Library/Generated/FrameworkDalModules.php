<?php
/**
 * Lists the constants for framework dal module classes for autocompletion and easy coding.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package FrameworkDalModules
 */

namespace Library\Generated;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class FrameworkDalModules {
  const CommonDal = 'CommonDal';  const DocumentDal = 'DocumentDal';  const LogDal = 'LogDal';  const UserDal = 'UserDal';  const _TemplateDal = '_TemplateDal';  public static function GetList() {    return array(      self::CommonDal => 'CommonDal',      self::DocumentDal => 'DocumentDal',      self::LogDal => 'LogDal',      self::UserDal => 'UserDal',      self::_TemplateDal => '_TemplateDal',    );  }}