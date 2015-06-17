<?php
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence * @link https://github.com/WebDevJL/EasyMVC* @since Version 1.0.0* @package F_user_role*/
namespace \Library\Dal\Modules;if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) { exit('No direct script access allowed'); }
class F_user_role extends \Library\Entity {  public     $f_user_role_id,    $f_user_role_desc;
  /**    * Sets f_user_role_id if the value passed match the type expected, otherwise throws an exception.  */  public function setF_user_role_id($f_user_role_id) {      $this->f_user_role_id = $f_user_role_id;  }
  /**    * Sets f_user_role_desc if the value passed match the type expected, otherwise throws an exception.  */  public function setF_user_role_desc($f_user_role_desc) {      $this->f_user_role_desc = $f_user_role_desc;  }
  /**    * Gets f_user_role_id.  */  public function F_user_role_id() {    return $this->f_user_role_id;  }
  /**    * Gets f_user_role_desc.  */  public function F_user_role_desc() {    return $this->f_user_role_desc;  }
}