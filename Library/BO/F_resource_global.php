<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2* @package F_resource_global*/
class F_resource_global extends \Library\Core\Entity {  const F_RESOURCE_GLOBAL_KEY = "f_resource_global_key";  const F_RESOURCE_GLOBAL_VALUE = "f_resource_global_value";  const F_CULTURE_ID = "f_culture_id";
  protected     $f_resource_global_key,    $f_resource_global_value,    $f_culture_id;
  /**    * Sets f_resource_global_key.  */  public function setF_resource_global_key($f_resource_global_key) {      $this->f_resource_global_key = $f_resource_global_key;  }
  /**    * Sets f_resource_global_value.  */  public function setF_resource_global_value($f_resource_global_value) {      $this->f_resource_global_value = $f_resource_global_value;  }
  /**    * Sets f_culture_id.  */  public function setF_culture_id($f_culture_id) {      $this->f_culture_id = $f_culture_id;  }
  /**    * Gets f_resource_global_key.  */  public function F_resource_global_key() {    return $this->f_resource_global_key;  }
  /**    * Gets f_resource_global_value.  */  public function F_resource_global_value() {    return $this->f_resource_global_value;  }
  /**    * Gets f_culture_id.  */  public function F_culture_id() {    return $this->f_culture_id;  }
}