<?php

/**
 * Provides functions to extract a list of values in a nested associative array.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ArrayExtractionHelper
 */

namespace Library\Helpers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ArrayExtractionHelper {
  
  public $List;
  
  public function __construct() {
    $this->List = array();
  }
  
  public static function Init() {
    $extractor = new ArrayExtractionHelper();
    return $extractor;
  }
  public function ExtractDistinctValues($array) {
    //DebugHelper::WriteObject($array, TRUE);
    foreach ($array as $key => $value) {
      $valueIsArray = is_array($value);
      $valueIsAlreadyExtracted = in_array($value, $this->List);
      $keyIsExtracted = in_array($key, $this->List);
      if (!$valueIsArray && !$valueIsAlreadyExtracted && !RegexHelper::Init($value)->StringContainsWhiteSpace()) {
        array_push($this->List, $value);
      } 
      if (!$keyIsExtracted && is_string($key) && !RegexHelper::Init($key)->StringContainsWhiteSpace()) {
        array_push($this->List, $key);
      } 
      if ($valueIsArray) {
        $this->ExtractDistinctValues($value);
      }
    }
    return $this;
  }


}
