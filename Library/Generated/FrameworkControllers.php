<?php
/**
 * Lists the constants for framework controller classes to autocompletion and easy coding.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package FrameworkControllers
 */

namespace Library\Generated;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class FrameworkControllers {
  const CONFIGCONTROLLER = 'ConfigController';  const DEBUGCONTROLLER = 'DebugController';  const ERRORCONTROLLER = 'ErrorController';  const FILECONTROLLER = 'FileController';  const GENERATORCONTROLLER = 'GeneratorController';  const WEBIDEAJAXCONTROLLER = 'WebIdeAjaxController';  const WEBIDECONTROLLER = 'WebIdeController';  public static function GetList() {    return array(      self::CONFIGCONTROLLER => 'ConfigController',      self::DEBUGCONTROLLER => 'DebugController',      self::ERRORCONTROLLER => 'ErrorController',      self::FILECONTROLLER => 'FileController',      self::GENERATORCONTROLLER => 'GeneratorController',      self::WEBIDEAJAXCONTROLLER => 'WebIdeAjaxController',      self::WEBIDECONTROLLER => 'WebIdeController',    );  }}