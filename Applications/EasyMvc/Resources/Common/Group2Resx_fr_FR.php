<?php
/**
 * List of the resources values for the group group2
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package Group2Resx_fr_FR extends Group2Resx
 */

namespace Applications\EasyMvc\Resources\Common;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class Group2Resx_fr_FR extends Group2Resx {
  public function GetList() {    return array(      self::TEST2 => array(        self::F_COMMON_RESOURCE_VALUE => "C'est une valeur de test2",        self::F_COMMON_RESOURCE_COMMENT => "Testing purpose",      ),      self::TEST3 => array(        self::F_COMMON_RESOURCE_VALUE => "C'est une valeur de test3",        self::F_COMMON_RESOURCE_COMMENT => "Testing purpose",      ),    );  }
}