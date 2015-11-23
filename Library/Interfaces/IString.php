<?php
/**
 * Interface for String objects
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package IString
 */
namespace Library\Interfaces;
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
interface IString {
  /**
   * Method that retrieve the string value of the instance.
   */
  public function ToString();
}
