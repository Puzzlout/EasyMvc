<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2.1* @package F_log*/
class F_log extends \Library\Core\Entity {  const F_LOG_ID = "f_log_id";  const F_LOG_REQUEST_ID = "f_log_request_id";  const F_LOG_START = "f_log_start";  const F_LOG_END = "f_log_end";  const F_LOG_EXECUTION_TIME = "f_log_execution_time";  const F_LOG_TYPE = "f_log_type";  const F_LOG_FILTER = "f_log_filter";  const F_LOG_VALUE = "f_log_value";
  protected     $f_log_id,    $f_log_request_id,    $f_log_start,    $f_log_end,    $f_log_execution_time,    $f_log_type,    $f_log_filter,    $f_log_value;
  /**    * Sets f_log_id.  */  public function setF_log_id($f_log_id) {      $this->f_log_id = $f_log_id;  }
  /**    * Sets f_log_request_id.  */  public function setF_log_request_id($f_log_request_id) {      $this->f_log_request_id = $f_log_request_id;  }
  /**    * Sets f_log_start.  */  public function setF_log_start($f_log_start) {      $this->f_log_start = $f_log_start;  }
  /**    * Sets f_log_end.  */  public function setF_log_end($f_log_end) {      $this->f_log_end = $f_log_end;  }
  /**    * Sets f_log_execution_time.  */  public function setF_log_execution_time($f_log_execution_time) {      $this->f_log_execution_time = $f_log_execution_time;  }
  /**    * Sets f_log_type.  */  public function setF_log_type($f_log_type) {      $this->f_log_type = $f_log_type;  }
  /**    * Sets f_log_filter.  */  public function setF_log_filter($f_log_filter) {      $this->f_log_filter = $f_log_filter;  }
  /**    * Sets f_log_value.  */  public function setF_log_value($f_log_value) {      $this->f_log_value = $f_log_value;  }
  /**    * Gets f_log_id.  */  public function F_log_id() {    return $this->f_log_id;  }
  /**    * Gets f_log_request_id.  */  public function F_log_request_id() {    return $this->f_log_request_id;  }
  /**    * Gets f_log_start.  */  public function F_log_start() {    return $this->f_log_start;  }
  /**    * Gets f_log_end.  */  public function F_log_end() {    return $this->f_log_end;  }
  /**    * Gets f_log_execution_time.  */  public function F_log_execution_time() {    return $this->f_log_execution_time;  }
  /**    * Gets f_log_type.  */  public function F_log_type() {    return $this->f_log_type;  }
  /**    * Gets f_log_filter.  */  public function F_log_filter() {    return $this->f_log_filter;  }
  /**    * Gets f_log_value.  */  public function F_log_value() {    return $this->f_log_value;  }
}