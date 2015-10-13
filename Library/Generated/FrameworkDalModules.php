<?php
/**
 * Lists the constants for framework dal module classes for autocompletion and easy coding.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC/blob/master/README.md
 * @since Version 1.0.2.1
 * @package FrameworkDalModules
 */

namespace Library\Generated;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class FrameworkDalModules {
  const CommonDalKey = 'CommonDalKey';  const DocumentDalKey = 'DocumentDalKey';  const LogDalKey = 'LogDalKey';  const UserDalKey = 'UserDalKey';  const _TemplateDalKey = '_TemplateDalKey';  public static function GetList() {    return array(      self::CommonDalKey => 'CommonDal',      self::DocumentDalKey => 'DocumentDal',      self::LogDalKey => 'LogDal',      self::UserDalKey => 'UserDal',      self::_TemplateDalKey => '_TemplateDal',    );  }
  public static function DoesConstantExist($key) {    return array_key_exists($key, self::GetList());  }}