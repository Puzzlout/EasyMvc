<?php
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2.1* @package EasyMvcControllers*/namespace Applications\EasyMvc\Generated;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }

class EasyMvcControllers {  const AccountControllerKey = 'AccountControllerKey';  public static function GetList() {    return array(        self::AccountControllerKey => 'AccountController',    );  }
  public static function DoesControllerExist($key) {    return array_key_exists($key, self::GetList());  }}