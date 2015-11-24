<?php

/**
 * Class String.
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

use \Library\Interfaces;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class String extends ObjectBase implements Interfaces\IObjectInitialization, Interfaces\IObject, Interfaces\IString {

  public $value;

  /**
   * Create a String object with an empty scarlar string
   * 
   * @return \ScalarType\String
   */
  public static function Init() {
    $instance = new String();
    $instance->value = "";
    return $instance;
  }

  /**
   * Create a String object and assign the $value parameter to the instance scarlar string
   * 
   * @param string $value
   * @return \ScalarType\String
   * @throws \Exception
   */
  public static function InitWith($value) {
    if (!$this->IsValid($value)) {
      throw new \InvalidArgumentException('$value is not a String. See var_dump above' . var_dump($value), 0, NULL);
    }

    $instance = new String();
    $instance->value = $value;
    return $instance;
  }

  public function IsValid($value) {
    if (is_string($value)) {
      return TRUE;
    }
    throw new \InvalidArgumentException('$value is not a string', 0, NULL);
  }

  /**
   * 
   * @return The value of the object as a string.
   */
  public function ToString() {
    return $this->value;
  }

}
