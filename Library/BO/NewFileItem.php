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
class NewFileItem {

  public $fileName;
  public $fileDesc;
  public $fileDirPath;
  public $fileContents;
  
  public static function Init($dataAssocArray) {
    $instance = new NewFileItem($dataAssocArray);
    return $instance;
  }
  /**
   * 
   * @param type $id
   * @param type $type
   * @param type $title
   * @param type $dynamicValue
   */
  public function __construct($dataAssocArray) {
    foreach ($dataAssocArray as $key => $value) {
      $this->$key = $value;
    }
  }

}
