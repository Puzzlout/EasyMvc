<?php
/**
 * List of the resources for the groupgroup2 of common resources.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package group2Resx
 */

namespace Applications\EasyMvc\Ressources\Common;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class group2Resx {
  const test1Key = 'test1Key';  const f_common_resource_valueKey = 'f_common_resource_valueKey';  const f_common_resource_commentKey = 'f_common_resource_commentKey';  const test2Key = 'test2Key';  const f_common_resource_valueKey = 'f_common_resource_valueKey';  const f_common_resource_commentKey = 'f_common_resource_commentKey';  public static function GetList() {    return array(      self::test1Key => array(        self::f_common_resource_valueKey => "This is a test value1",        self::f_common_resource_commentKey => "Testing purpose",      ),      self::test2Key => array(        self::f_common_resource_valueKey => "This is a test value2",        self::f_common_resource_commentKey => "Testing purpose",      ),    );  }
  public static function DoesConstantExist($key) {    return array_key_exists($key, self::GetList());  }}