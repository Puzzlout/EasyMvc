<?php

/**
 * Provides functions with regular expressions.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package RegexHelper
 */

namespace Library\Helpers;
use Library\Enums\CommonRegexes;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class RegexHelper {
  
  public $List;
  public $valueToTest;


  public function __construct() {
    $this->List = array();
  }
  
  public function setValueToTest($valueToTest) {
    $this->valueToTest = $valueToTest;
  }
  public static function Init($valueToTest) {
    $regex = new RegexHelper();
    $regex->setValueToTest($valueToTest);
    return $regex;
  }
  public function StringContainsWhiteSpace() {
    if (is_array($this->valueToTest)) {
      return FALSE;
    }
    $result = preg_match(CommonRegexes::SearchWhiteSpace, $this->valueToTest);
    return $result;
  }

  public function IsResoureKeyValid() {
    $result = preg_match_all(CommonRegexes::ResourceKeyValidation, $this->valueToTest);
    return $result;
  }

  public function IsAPhpFilename() {
    $result = preg_match(CommonRegexes::SearchPhpExtension, $this->valueToTest);
    return $result;
  }
  
  public function IsMatch($pattern) {
    $result = preg_match($pattern, $this->valueToTest);
    return $result;
  }
}
