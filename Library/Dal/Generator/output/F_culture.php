<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2* @package F_culture*/
class F_culture extends \Library\Core\Entity {  const F_CULTURE_ID = "f_culture_id";  const F_CULTURE_VALUE = "f_culture_value";
  protected     $f_culture_id,    $f_culture_value;
  /**    * Sets f_culture_id.  */  public function setF_culture_id($f_culture_id) {      $this->f_culture_id = $f_culture_id;  }
  /**    * Sets f_culture_value.  */  public function setF_culture_value($f_culture_value) {      $this->f_culture_value = $f_culture_value;  }
  /**    * Gets f_culture_id.  */  public function F_culture_id() {    return $this->f_culture_id;  }
  /**    * Gets f_culture_value.  */  public function F_culture_value() {    return $this->f_culture_value;  }
}