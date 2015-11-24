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
  const ConfigController = 'ConfigController';  const DebugController = 'DebugController';  const ErrorController = 'ErrorController';  const FileController = 'FileController';  const GeneratorController = 'GeneratorController';  const WebIdeAjaxController = 'WebIdeAjaxController';  const WebIdeController = 'WebIdeController';  public static function GetList() {    return array(      self::ConfigController => 'ConfigController',      self::DebugController => 'DebugController',      self::ErrorController => 'ErrorController',      self::FileController => 'FileController',      self::GeneratorController => 'GeneratorController',      self::WebIdeAjaxController => 'WebIdeAjaxController',      self::WebIdeController => 'WebIdeController',    );  }}