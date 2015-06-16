<?php
/**** @author Jeremie Litzler* @copyright Copyright (c) 2015* @link * @since Version 1.0.0* @package F_log.php*/
namespace \Library\Dal\Modules\;F_logif ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');
class F_log extends \Library\Entity {  public     $f_log_id,    $f_log_request_id,    $f_log_start,    $f_log_end,    $f_log_execution_time,    $f_log_type,    $f_log_filter,    $f_log_value;
  const     F_LOG_ID_ERR = 0,    F_LOG_REQUEST_ID_ERR = 1,    F_LOG_START_ERR = 2,    F_LOG_END_ERR = 3,    F_LOG_EXECUTION_TIME_ERR = 4,    F_LOG_TYPE_ERR = 5,    F_LOG_FILTER_ERR = 6,    F_LOG_VALUE_ERR = 7;
  // SETTERS //  public function setF_log_id($f_log_id) {      $this->f_log_id = $f_log_id;  }
  public function setF_log_request_id($f_log_request_id) {      $this->f_log_request_id = $f_log_request_id;  }
  public function setF_log_start($f_log_start) {      $this->f_log_start = $f_log_start;  }
  public function setF_log_end($f_log_end) {      $this->f_log_end = $f_log_end;  }
  public function setF_log_execution_time($f_log_execution_time) {      $this->f_log_execution_time = $f_log_execution_time;  }
  public function setF_log_type($f_log_type) {      $this->f_log_type = $f_log_type;  }
  public function setF_log_filter($f_log_filter) {      $this->f_log_filter = $f_log_filter;  }
  public function setF_log_value($f_log_value) {      $this->f_log_value = $f_log_value;  }
  // GETTERS //  public function f_log_id() {    return $this->f_log_id;  }
  public function f_log_request_id() {    return $this->f_log_request_id;  }
  public function f_log_start() {    return $this->f_log_start;  }
  public function f_log_end() {    return $this->f_log_end;  }
  public function f_log_execution_time() {    return $this->f_log_execution_time;  }
  public function f_log_type() {    return $this->f_log_type;  }
  public function f_log_filter() {    return $this->f_log_filter;  }
  public function f_log_value() {    return $this->f_log_value;  }
}