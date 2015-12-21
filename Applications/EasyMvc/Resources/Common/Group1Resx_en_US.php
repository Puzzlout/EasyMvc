<?php
/**
 * List of the resources values for the group group1
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package Group1Resx_en_US extends Group1Resx
 */

namespace Applications\EasyMvc\Resources\Common;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class Group1Resx_en_US extends Group1Resx {
  public function GetList() {    return array(      self::TEST => array(        self::F_COMMON_RESOURCE_VALUE => "This is a test value",        self::F_COMMON_RESOURCE_COMMENT => "Testing purpose",      ),      self::TEST1 => array(        self::F_COMMON_RESOURCE_VALUE => "This is a test value1",        self::F_COMMON_RESOURCE_COMMENT => "Testing purpose",      ),    );  }
}