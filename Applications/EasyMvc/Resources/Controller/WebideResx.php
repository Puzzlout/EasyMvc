<?php
/**
 * List of the resources values for the module generator
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package WebideResx
 */

namespace Applications\EasyMvc\Resources\Controller;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class WebideResx {
  const CREATEFILE = 'createfile';  const PAGETITLE = 'pagetitle';  const F_CONTROLLER_RESOURCE_VALUE = 'f_controller_resource_value';  const F_CONTROLLER_RESOURCE_COMMENT = 'f_controller_resource_comment';}