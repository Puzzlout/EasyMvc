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

class String extends ObjectBase implements IString {
  public $value;
  
  /**
   * Create a String object with a value
   * 
   * @param string $value The value to store in instance.
   * @return String The instance of String
   * @todo create new exception: InvalidArgumentException
   * @todo create error code
   */
  public static function Init($value) {
    $instance = new String();
    if ($instance->IsValid($value)) {
      $instance->value = $value;
      return $instance; 
    }
    throw new \Exception('$value is not a String. See var_dump above' . var_dump($value), 0, NULL);
  }
  
  /**
   * 
   * @return The value of the object as a string.
   */
  public function ToString() {
    return $this->value;
  }
}
