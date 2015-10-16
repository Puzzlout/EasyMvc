<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2.1* @package F_control_resource*/
class F_control_resource extends \Library\Core\Entity {  const F_CONTROL_RESOURCE_KEY = "f_control_resource_key";  const F_CONTROL_RESOURCE_ACTION = "f_control_resource_action";  const F_CONTROL_RESOURCE_MODULE = "f_control_resource_module";  const F_CONTROL_RESOURCE_VALUE = "f_control_resource_value";  const F_CULTURE_ID = "f_culture_id";
  protected     $f_control_resource_key,    $f_control_resource_action,    $f_control_resource_module,    $f_control_resource_value,    $f_culture_id;
  /**    * Sets f_control_resource_key.  */  public function setF_control_resource_key($f_control_resource_key) {      $this->f_control_resource_key = $f_control_resource_key;  }
  /**    * Sets f_control_resource_action.  */  public function setF_control_resource_action($f_control_resource_action) {      $this->f_control_resource_action = $f_control_resource_action;  }
  /**    * Sets f_control_resource_module.  */  public function setF_control_resource_module($f_control_resource_module) {      $this->f_control_resource_module = $f_control_resource_module;  }
  /**    * Sets f_control_resource_value.  */  public function setF_control_resource_value($f_control_resource_value) {      $this->f_control_resource_value = $f_control_resource_value;  }
  /**    * Sets f_culture_id.  */  public function setF_culture_id($f_culture_id) {      $this->f_culture_id = $f_culture_id;  }
  /**    * Gets f_control_resource_key.  */  public function F_control_resource_key() {    return $this->f_control_resource_key;  }
  /**    * Gets f_control_resource_action.  */  public function F_control_resource_action() {    return $this->f_control_resource_action;  }
  /**    * Gets f_control_resource_module.  */  public function F_control_resource_module() {    return $this->f_control_resource_module;  }
  /**    * Gets f_control_resource_value.  */  public function F_control_resource_value() {    return $this->f_control_resource_value;  }
  /**    * Gets f_culture_id.  */  public function F_culture_id() {    return $this->f_culture_id;  }
}