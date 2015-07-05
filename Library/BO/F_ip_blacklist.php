<?php
namespace Library\BO;
if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) { exit('No direct script access allowed'); }

/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.0* @package F_ip_blacklist*/
class F_ip_blacklist extends \Library\Core\Entity {  const F_IP_BLACKLIST_ID = "f_ip_blacklist_id";
  const F_IP_BLACKLIST_IP_VALUE = "f_ip_blacklist_ip_value";
  const F_IP_BLACKLIST_ATTEMPTS = "f_ip_blacklist_attempts";
  const F_IP_BLACKLIST_TIMESTAMP = "f_ip_blacklist_timestamp";
  const F_IP_BLACKLIST_EXPIRED = "f_ip_blacklist_expired";
  const F_ACTION_KEY = "f_action_key";

  protected     $f_ip_blacklist_id,    $f_ip_blacklist_ip_value,    $f_ip_blacklist_attempts,    $f_ip_blacklist_timestamp,    $f_ip_blacklist_expired,    $f_action_key;
  /**    * Sets f_ip_blacklist_id.  */  public function setF_ip_blacklist_id($f_ip_blacklist_id) {      $this->f_ip_blacklist_id = $f_ip_blacklist_id;  }
  /**    * Sets f_ip_blacklist_ip_value.  */  public function setF_ip_blacklist_ip_value($f_ip_blacklist_ip_value) {      $this->f_ip_blacklist_ip_value = $f_ip_blacklist_ip_value;  }
  /**    * Sets f_ip_blacklist_attempts.  */  public function setF_ip_blacklist_attempts($f_ip_blacklist_attempts) {      $this->f_ip_blacklist_attempts = $f_ip_blacklist_attempts;  }
  /**    * Sets f_ip_blacklist_timestamp.  */  public function setF_ip_blacklist_timestamp($f_ip_blacklist_timestamp) {      $this->f_ip_blacklist_timestamp = $f_ip_blacklist_timestamp;  }
  /**    * Sets f_ip_blacklist_expired.  */  public function setF_ip_blacklist_expired($f_ip_blacklist_expired) {      $this->f_ip_blacklist_expired = $f_ip_blacklist_expired;  }
  /**    * Sets f_action_key.  */  public function setF_action_key($f_action_key) {      $this->f_action_key = $f_action_key;  }
  /**    * Gets f_ip_blacklist_id.  */  public function F_ip_blacklist_id() {    return $this->f_ip_blacklist_id;  }
  /**    * Gets f_ip_blacklist_ip_value.  */  public function F_ip_blacklist_ip_value() {    return $this->f_ip_blacklist_ip_value;  }
  /**    * Gets f_ip_blacklist_attempts.  */  public function F_ip_blacklist_attempts() {    return $this->f_ip_blacklist_attempts;  }
  /**    * Gets f_ip_blacklist_timestamp.  */  public function F_ip_blacklist_timestamp() {    return $this->f_ip_blacklist_timestamp;  }
  /**    * Gets f_ip_blacklist_expired.  */  public function F_ip_blacklist_expired() {    return $this->f_ip_blacklist_expired;  }
  /**    * Gets f_action_key.  */  public function F_action_key() {    return $this->f_action_key;  }
}