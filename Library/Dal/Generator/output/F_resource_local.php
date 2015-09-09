<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2* @package F_resource_local*/
class F_resource_local extends \Library\Core\Entity {  const F_RESOURCE_LOCAL_KEY = "f_resource_local_key";  const F_CULTURE_ID = "f_culture_id";  const F_RESOURCE_LOCAL_VALUE = "f_resource_local_value";  const F_RESOURCE_LOCAL_MODULE = "f_resource_local_module";  const F_RESOURCE_LOCAL_ACTION = "f_resource_local_action";
  protected     $f_resource_local_key,    $f_culture_id,    $f_resource_local_value,    $f_resource_local_module,    $f_resource_local_action;
  /**    * Sets f_resource_local_key.  */  public function setF_resource_local_key($f_resource_local_key) {      $this->f_resource_local_key = $f_resource_local_key;  }
  /**    * Sets f_culture_id.  */  public function setF_culture_id($f_culture_id) {      $this->f_culture_id = $f_culture_id;  }
  /**    * Sets f_resource_local_value.  */  public function setF_resource_local_value($f_resource_local_value) {      $this->f_resource_local_value = $f_resource_local_value;  }
  /**    * Sets f_resource_local_module.  */  public function setF_resource_local_module($f_resource_local_module) {      $this->f_resource_local_module = $f_resource_local_module;  }
  /**    * Sets f_resource_local_action.  */  public function setF_resource_local_action($f_resource_local_action) {      $this->f_resource_local_action = $f_resource_local_action;  }
  /**    * Gets f_resource_local_key.  */  public function F_resource_local_key() {    return $this->f_resource_local_key;  }
  /**    * Gets f_culture_id.  */  public function F_culture_id() {    return $this->f_culture_id;  }
  /**    * Gets f_resource_local_value.  */  public function F_resource_local_value() {    return $this->f_resource_local_value;  }
  /**    * Gets f_resource_local_module.  */  public function F_resource_local_module() {    return $this->f_resource_local_module;  }
  /**    * Gets f_resource_local_action.  */  public function F_resource_local_action() {    return $this->f_resource_local_action;  }
}