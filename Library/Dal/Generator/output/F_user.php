<?php
/**** @author Jeremie Litzler* @copyright Copyright (c) 2015* @link * @since Version 1.0.0* @package F_user.php*/
namespace \Library\Dal\Modules\;F_userif ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');
class F_user extends \Library\Entity {  public     $f_user_id,    $f_user_login,    $f_user_password,    $f_user_salt,    $f_user_hint,    $f_user_email,    $f_user_role_id,    $f_user_session_id;
  const     F_USER_ID_ERR = 0,    F_USER_LOGIN_ERR = 1,    F_USER_PASSWORD_ERR = 2,    F_USER_SALT_ERR = 3,    F_USER_HINT_ERR = 4,    F_USER_EMAIL_ERR = 5,    F_USER_ROLE_ID_ERR = 6,    F_USER_SESSION_ID_ERR = 7;
  // SETTERS //  public function setF_user_id($f_user_id) {      $this->f_user_id = $f_user_id;  }
  public function setF_user_login($f_user_login) {      $this->f_user_login = $f_user_login;  }
  public function setF_user_password($f_user_password) {      $this->f_user_password = $f_user_password;  }
  public function setF_user_salt($f_user_salt) {      $this->f_user_salt = $f_user_salt;  }
  public function setF_user_hint($f_user_hint) {      $this->f_user_hint = $f_user_hint;  }
  public function setF_user_email($f_user_email) {      $this->f_user_email = $f_user_email;  }
  public function setF_user_role_id($f_user_role_id) {      $this->f_user_role_id = $f_user_role_id;  }
  public function setF_user_session_id($f_user_session_id) {      $this->f_user_session_id = $f_user_session_id;  }
  // GETTERS //  public function f_user_id() {    return $this->f_user_id;  }
  public function f_user_login() {    return $this->f_user_login;  }
  public function f_user_password() {    return $this->f_user_password;  }
  public function f_user_salt() {    return $this->f_user_salt;  }
  public function f_user_hint() {    return $this->f_user_hint;  }
  public function f_user_email() {    return $this->f_user_email;  }
  public function f_user_role_id() {    return $this->f_user_role_id;  }
  public function f_user_session_id() {    return $this->f_user_session_id;  }
}