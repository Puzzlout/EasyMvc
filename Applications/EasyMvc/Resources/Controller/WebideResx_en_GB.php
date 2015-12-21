<?php
/**
 * List of the resources values for the module webide
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package WebideResx_en_GB extends WebideResx
 */

namespace Applications\EasyMvc\Resources\Controller;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class WebideResx_en_GB extends WebideResx {
  public function GetList() {    return array(      self::CREATEFILE => array(        self::PAGETITLE => array(        self::F_CONTROLLER_RESOURCE_VALUE => "IDE - Create a file or class",        self::F_CONTROLLER_RESOURCE_COMMENT => "Page title",      ),      ),    );  }
}