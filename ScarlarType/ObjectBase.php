<?php

/**
 * Class with the properties needs to generate a class file.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package BaseClassGenerator
 * @see http://php.net/manual/en/language.types.intro.php
 */

namespace ScalarType;
use Library\Interfaces;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class ObjectBase implements Interfaces\IObject, Interfaces\IString {
  protected $value;

  /**
   * 
   * @return string The type of the instance.
   * @see http://php.net/manual/en/function.gettype.php
   */
  public function GetType() {
    return gettype($this);
  }
  /**
   * 
   * @return string The class name of the instance
   * @see http://php.net/manual/en/function.get-class.php (go to Example #2)
   */
  public function GetClass() {
    return get_class();
  }

  /**
   * 
   * @return string The string cast of $value field of the instance.
   */
  public function ToString() {
    return (string) $this->value;
  }
}
