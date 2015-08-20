<?php

/**
 * Controllers to manage the different authentication methods (login, logout, etc.)
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package FrameworkPlaceholders
 */

namespace Library\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class FrameworkPlaceholders {
/**
 * For Application name.  
 */
  const ApplicationNamePlaceHolder = "{{app_name}}";
}