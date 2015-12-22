<?php

/**
 * Class to store the element of a new file.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package NewFileItem
 */

namespace Library\BO;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
class NewFileItem implements \JsonSerializable {

  public $fileName;
  public $fileDesc;
  public $fileDirPath;
  public $fileContents;
  
  public static function Init() {
    $instance = new NewFileItem();
    return $instance;
  }
  /**
   * 
   * @param array $dataAssocArray
   */
  public function Fill($dataAssocArray) {
    foreach ($dataAssocArray as $key => $value) {
      if(!property_exists($this, $key)) {
        throw new \Exception("Property $key doesn't exist in the class ". __CLASS__, 0, NULL);
      }
      $this->$key = $value;
    }
    return $this;
  }
  
  public function jsonSerialize() {
    $serializedThis = (array) $this;
    return $serializedThis;
  }
}
