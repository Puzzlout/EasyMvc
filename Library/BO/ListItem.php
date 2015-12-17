<?php

/**
 * Class to store a autocomplete item.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ListItem
 */

namespace Library\BO;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
class ListItem {

  public $value;
  public $label;
  
  public static function Init($value, $label) {
    $instance = new ListItem($value, $label);
    return $instance;
  }
  /**
   * 
   * @param type $id
   * @param type $type
   * @param type $title
   * @param type $dynamicValue
   */
  public function __construct($value, $label) {
    $this->value = $value;
    $this->label = $label;
  }

}
