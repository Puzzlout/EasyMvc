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
  const ConfigControllerKey = 'ConfigControllerKey';  const DebugControllerKey = 'DebugControllerKey';  const ErrorControllerKey = 'ErrorControllerKey';  const FileControllerKey = 'FileControllerKey';  const GeneratorControllerKey = 'GeneratorControllerKey';  public static function GetList() {    return array(      self::ConfigControllerKey => 'ConfigController',      self::DebugControllerKey => 'DebugController',      self::ErrorControllerKey => 'ErrorController',      self::FileControllerKey => 'FileController',      self::GeneratorControllerKey => 'GeneratorController',    );  }}