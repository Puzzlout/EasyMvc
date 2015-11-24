<?php
/**
 * Interface to base objects handling
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package IObject
 */
namespace Library\Interfaces;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
interface IObject {
  /**
   * Method that retrieve the instance type.
   */
  public function GetType();
  /**
   * Method that retrieve the instance class value.
   */
  public function GetClass();

  /**
   * Method that validates the value is correct before assigning it to the Object 
   * value field.
   */
  public function IsValid($value);
}
