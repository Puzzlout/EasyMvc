<?php
/**** @author Jeremie Litzler* @copyright Copyright (c) 2015* @link * @since Version 1.0.0* @package F_account.php*/
namespace \Library\Dal\Modules\;F_accountif ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');
class F_account extends \Library\Entity {  public     $f_account_id,    $f_account_name,    $f_account_desc,    $f_account_active,    $f_account_visible,    $f_user_id;
  const     F_ACCOUNT_ID_ERR = 0,    F_ACCOUNT_NAME_ERR = 1,    F_ACCOUNT_DESC_ERR = 2,    F_ACCOUNT_ACTIVE_ERR = 3,    F_ACCOUNT_VISIBLE_ERR = 4,    F_USER_ID_ERR = 5;
  // SETTERS //  public function setF_account_id($f_account_id) {      $this->f_account_id = $f_account_id;  }
  public function setF_account_name($f_account_name) {      $this->f_account_name = $f_account_name;  }
  public function setF_account_desc($f_account_desc) {      $this->f_account_desc = $f_account_desc;  }
  public function setF_account_active($f_account_active) {      $this->f_account_active = $f_account_active;  }
  public function setF_account_visible($f_account_visible) {      $this->f_account_visible = $f_account_visible;  }
  public function setF_user_id($f_user_id) {      $this->f_user_id = $f_user_id;  }
  // GETTERS //  public function f_account_id() {    return $this->f_account_id;  }
  public function f_account_name() {    return $this->f_account_name;  }
  public function f_account_desc() {    return $this->f_account_desc;  }
  public function f_account_active() {    return $this->f_account_active;  }
  public function f_account_visible() {    return $this->f_account_visible;  }
  public function f_user_id() {    return $this->f_user_id;  }
}