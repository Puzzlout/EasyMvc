<?php
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2.1* @package EasyMvcDalModules*/namespace Applications\EasyMvc\Generated;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }

class EasyMvcDalModules {  const LoginDalKey = 'LoginDalKey';  const _TemplateDalKey = '_TemplateDalKey';  public static function GetList() {    return array(        self::LoginDalKey => 'LoginDal',        self::_TemplateDalKey => '_TemplateDal',    );  }
  public static function DoesConstantExist($key) {    return array_key_exists($key, self::GetList());  }}