<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2.1* @package F_common_resource*/
class F_common_resource extends \Library\Core\Entity {  const F_COMMON_RESOURCE_KEY = "f_common_resource_key";  const F_COMMON_RESOURCE_VALUE = "f_common_resource_value";  const F_CULTURE_ID = "f_culture_id";
  protected     $f_common_resource_key,    $f_common_resource_value,    $f_culture_id;
  /**    * Sets f_common_resource_key.  */  public function setF_common_resource_key($f_common_resource_key) {      $this->f_common_resource_key = $f_common_resource_key;  }
  /**    * Sets f_common_resource_value.  */  public function setF_common_resource_value($f_common_resource_value) {      $this->f_common_resource_value = $f_common_resource_value;  }
  /**    * Sets f_culture_id.  */  public function setF_culture_id($f_culture_id) {      $this->f_culture_id = $f_culture_id;  }
  /**    * Gets f_common_resource_key.  */  public function F_common_resource_key() {    return $this->f_common_resource_key;  }
  /**    * Gets f_common_resource_value.  */  public function F_common_resource_value() {    return $this->f_common_resource_value;  }
  /**    * Gets f_culture_id.  */  public function F_culture_id() {    return $this->f_culture_id;  }
}