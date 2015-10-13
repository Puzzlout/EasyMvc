<?php
/**
 * Lists the constants for framework view files to autocompletion and easy coding.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC/blob/master/README.md
 * @since Version 1.0.2.1
 * @package FrameworkViews
 */

namespace Library\Generated;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class FrameworkViews {
  const ConfigFolderKey = 'ConfigFolderKey';  const ModulesFolderKey = 'ModulesFolderKey';  const configRoutingKey = 'configRoutingKey';  public static function GetList() {    return array(      self::ConfigFolderKey => array(        self::ModulesFolderKey => array(      ),        self::configRoutingKey => 'configRouting',      ),    );  }
  public static function DoesConstantExist($key) {    return array_key_exists($key, self::GetList());  }}