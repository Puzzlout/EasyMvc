<?php

namespace Applications\Test\Config;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

/**
 * Array of values to use in the application.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package AppSettings
 */
class AppSettings {
  /**
   * Retrieve the appsettings.
   * 
   * @return associative array : key/value array.
   * @see \Library\Enums\AppSettingKeys : list of keys used in the array.
   */
  public static function Get() {
    return array();
  }  
}