<?php
/**
 * List of the resources values for the module generator
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package GeneratorResx_en_GB extends GeneratorResx
 */

namespace Applications\EasyMvc\Resources\Controller;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class GeneratorResx_en_GB extends GeneratorResx {
  public function GetList() {    return array(      self::BUILDDAO => array(        self::PAGETITLE => array(        self::F_CONTROLLER_RESOURCE_VALUE => "Code generation - DAO",        self::F_CONTROLLER_RESOURCE_COMMENT => "Page title",      ),      ),      self::BUILDRESOURCES => array(        self::PAGETITLE => array(        self::F_CONTROLLER_RESOURCE_VALUE => "Code generation - Resources",        self::F_CONTROLLER_RESOURCE_COMMENT => "Page title",      ),      ),    );  }
}