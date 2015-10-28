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

namespace Applications\EasyMvc\Ressources\Common;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class Group2Resx_fr_FR extends Group2Resx {
  public static function GetList() {    return array(      self::test2Key => array(        self::f_common_resource_valueKey => "C'est une valeur de test2",        self::f_common_resource_commentKey => "Testing purpose",      ),      self::test3Key => array(        self::f_common_resource_valueKey => "C'est une valeur de test3",        self::f_common_resource_commentKey => "Testing purpose",      ),    );  }
}