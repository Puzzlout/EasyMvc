<?php
/**
 * List of the resources for the groupgroup1 of common resources.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package group1Resx
 */

namespace Applications\EasyMvc\Ressources\Common;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class group1Resx {
  const testKey = 'testKey';  const test3Key = 'test3Key';  public static function GetList() {    return array(      self::testFolderKey => array(        self::This is a test valueKey => 'This is a test value',        self::Testing purposeKey => 'Testing purpose',      ),      self::test3FolderKey => array(        self::This is a test value3Key => 'This is a test value3',        self::Testing purposeKey => 'Testing purpose',      ),    );  }
  public static function DoesConstantExist($key) {    return array_key_exists($key, self::GetList());  }}