<?php

/**
 * Class to manage a HTML attribute.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package HtmlAttribute
 */

namespace Library\UC;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class HtmlAttribute {
  /**
   *
   * @var string
   */
  public $Value;
  /**
   *
   * @var string
   */
  public $Name;

  /**
   * Constructor of the class.
   * 
   * @param string $name The name of the attribute
   * @param string $value The value of the attribute
   */
  public function __construct($name, $value) {
    $this->Name = $name;
    $this->Value = $value;
  }
  
  /**
   * Instanciate a HtmlAttribute object.
   * 
   * @param string $name The name of the attribute
   * @param string $value The value of the attribute
   * @return \Library\UC\HtmlAttribute
   */
  public static function Instanciate($name, $value) {
    $attr = new HtmlAttribute($name, $value);
    return $attr;
  }
}
