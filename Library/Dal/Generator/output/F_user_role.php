<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2* @package F_user_role*/
class F_user_role extends \Library\Core\Entity {  const F_USER_ROLE_ID = "f_user_role_id";  const F_USER_ROLE_DESC = "f_user_role_desc";
  protected     $f_user_role_id,    $f_user_role_desc;
  /**    * Sets f_user_role_id.  */  public function setF_user_role_id($f_user_role_id) {      $this->f_user_role_id = $f_user_role_id;  }
  /**    * Sets f_user_role_desc.  */  public function setF_user_role_desc($f_user_role_desc) {      $this->f_user_role_desc = $f_user_role_desc;  }
  /**    * Gets f_user_role_id.  */  public function F_user_role_id() {    return $this->f_user_role_id;  }
  /**    * Gets f_user_role_desc.  */  public function F_user_role_desc() {    return $this->f_user_role_desc;  }
}