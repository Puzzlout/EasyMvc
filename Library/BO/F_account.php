<?php
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/EasyMVC* @since Version 1.0.0* @package F_account*/
namespace Library\BO;if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) { exit('No direct script access allowed'); }
class F_account extends \Library\Core\Entity {  protected     $f_account_id,    $f_account_name,    $f_account_desc,    $f_account_active,    $f_account_visible,    $f_user_id;
  /**    * Sets f_account_id.  */  public function setF_account_id($f_account_id) {      $this->f_account_id = $f_account_id;  }
  /**    * Sets f_account_name.  */  public function setF_account_name($f_account_name) {      $this->f_account_name = $f_account_name;  }
  /**    * Sets f_account_desc.  */  public function setF_account_desc($f_account_desc) {      $this->f_account_desc = $f_account_desc;  }
  /**    * Sets f_account_active.  */  public function setF_account_active($f_account_active) {      $this->f_account_active = $f_account_active;  }
  /**    * Sets f_account_visible.  */  public function setF_account_visible($f_account_visible) {      $this->f_account_visible = $f_account_visible;  }
  /**    * Sets f_user_id.  */  public function setF_user_id($f_user_id) {      $this->f_user_id = $f_user_id;  }
  /**    * Gets f_account_id.  */  public function F_account_id() {    return $this->f_account_id;  }
  /**    * Gets f_account_name.  */  public function F_account_name() {    return $this->f_account_name;  }
  /**    * Gets f_account_desc.  */  public function F_account_desc() {    return $this->f_account_desc;  }
  /**    * Gets f_account_active.  */  public function F_account_active() {    return $this->f_account_active;  }
  /**    * Gets f_account_visible.  */  public function F_account_visible() {    return $this->f_account_visible;  }
  /**    * Gets f_user_id.  */  public function F_user_id() {    return $this->f_user_id;  }
}