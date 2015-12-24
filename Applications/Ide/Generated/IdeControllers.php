<?php
/**
 * Lists the constants for application controller classes to autocompletion and easy coding.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package IdeControllers
 */

namespace Applications\Ide\Generated;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class IdeControllers {
  const AJAXCONTROLLER = 'AjaxController';  const MAINCONTROLLER = 'MainController';  public static function GetList() {    return array(      self::AJAXCONTROLLER => 'AjaxController',      self::MAINCONTROLLER => 'MainController',    );  }}