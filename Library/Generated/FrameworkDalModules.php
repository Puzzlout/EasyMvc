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
  const COMMONDAL = 'CommonDal';  const DOCUMENTDAL = 'DocumentDal';  const LOGDAL = 'LogDal';  const USERDAL = 'UserDal';  const _TEMPLATEDAL = '_TemplateDal';  public static function GetList() {    return array(      self::COMMONDAL => 'CommonDal',      self::DOCUMENTDAL => 'DocumentDal',      self::LOGDAL => 'LogDal',      self::USERDAL => 'UserDal',      self::_TEMPLATEDAL => '_TemplateDal',    );  }}