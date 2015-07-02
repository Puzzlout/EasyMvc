<?php
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.0.2* @package F_action*/
namespace Library\BO;if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) { exit('No direct script access allowed'); }
class F_action extends \Library\Core\Entity {  protected     $f_action_key,    $f_action_description;
  /**    * Sets f_action_key.  */  public function setF_action_key($f_action_key) {      $this->f_action_key = $f_action_key;  }
  /**    * Sets f_action_description.  */  public function setF_action_description($f_action_description) {      $this->f_action_description = $f_action_description;  }
  /**    * Gets f_action_key.  */  public function F_action_key() {    return $this->f_action_key;  }
  /**    * Gets f_action_description.  */  public function F_action_description() {    return $this->f_action_description;  }
}