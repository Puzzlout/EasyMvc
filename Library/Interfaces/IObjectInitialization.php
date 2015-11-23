<?php
/**
 * Interface defining the contract to init objects
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package IObjectInitialization
 */
namespace Library\Interfaces;
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
interface IObjectInitialization {
  /**
   * Method that creates the instance of a class.
   */
  public static function Init();
}
