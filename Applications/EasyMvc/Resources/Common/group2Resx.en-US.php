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
  const test1Key = 'test1Key';  const test2Key = 'test2Key';  public static function GetList() {    return array(      self::test1FolderKey => array(        self::This is a test value1Key => 'This is a test value1',        self::Testing purposeKey => 'Testing purpose',      ),      self::test2FolderKey => array(        self::This is a test value2Key => 'This is a test value2',        self::Testing purposeKey => 'Testing purpose',      ),    );  }
  public static function DoesConstantExist($key) {    return array_key_exists($key, self::GetList());  }}