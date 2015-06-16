<?php
/**** @author Jeremie Litzler* @copyright Copyright (c) 2015* @link * @since Version 1.0.0* @package F_user_role.php*/
namespace \Library\Dal\Modules\;F_user_roleif ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');
class F_user_role extends \Library\Entity {  public     $f_user_role_id,    $f_user_role_desc;
  const     F_USER_ROLE_ID_ERR = 0,    F_USER_ROLE_DESC_ERR = 1;
  // SETTERS //  public function setF_user_role_id($f_user_role_id) {      $this->f_user_role_id = $f_user_role_id;  }
  public function setF_user_role_desc($f_user_role_desc) {      $this->f_user_role_desc = $f_user_role_desc;  }
  // GETTERS //  public function f_user_role_id() {    return $this->f_user_role_id;  }
  public function f_user_role_desc() {    return $this->f_user_role_desc;  }
}