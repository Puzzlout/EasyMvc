<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2.1* @package F_log*/
class F_log extends \Library\Core\Entity {  const F_LOG_ID = "f_log_id";  const F_LOG_GUID = "f_log_guid";  const F_LOG_REQUEST_ID = "f_log_request_id";  const F_LOG_LEVEL = "f_log_level";  const F_LOG_START = "f_log_start";  const F_LOG_END = "f_log_end";  const F_LOG_EXECUTION_TIME = "f_log_execution_time";  const F_LOG_SOURCE = "f_log_source";  const F_LOG_CONTEXT = "f_log_context";
  protected     $f_log_id,    $f_log_guid,    $f_log_request_id,    $f_log_level,    $f_log_start,    $f_log_end,    $f_log_execution_time,    $f_log_source,    $f_log_context;
  /**    * Sets f_log_id.  */  public function setF_log_id($f_log_id) {      $this->f_log_id = $f_log_id;  }
  /**    * Sets f_log_guid.  */  public function setF_log_guid($f_log_guid) {      $this->f_log_guid = $f_log_guid;  }
  /**    * Sets f_log_request_id.  */  public function setF_log_request_id($f_log_request_id) {      $this->f_log_request_id = $f_log_request_id;  }
  /**    * Sets f_log_level.  */  public function setF_log_level($f_log_level) {      $this->f_log_level = $f_log_level;  }
  /**    * Sets f_log_start.  */  public function setF_log_start($f_log_start) {      $this->f_log_start = $f_log_start;  }
  /**    * Sets f_log_end.  */  public function setF_log_end($f_log_end) {      $this->f_log_end = $f_log_end;  }
  /**    * Sets f_log_execution_time.  */  public function setF_log_execution_time($f_log_execution_time) {      $this->f_log_execution_time = $f_log_execution_time;  }
  /**    * Sets f_log_source.  */  public function setF_log_source($f_log_source) {      $this->f_log_source = $f_log_source;  }
  /**    * Sets f_log_context.  */  public function setF_log_context($f_log_context) {      $this->f_log_context = $f_log_context;  }
  /**    * Gets f_log_id.  */  public function F_log_id() {    return $this->f_log_id;  }
  /**    * Gets f_log_guid.  */  public function F_log_guid() {    return $this->f_log_guid;  }
  /**    * Gets f_log_request_id.  */  public function F_log_request_id() {    return $this->f_log_request_id;  }
  /**    * Gets f_log_level.  */  public function F_log_level() {    return $this->f_log_level;  }
  /**    * Gets f_log_start.  */  public function F_log_start() {    return $this->f_log_start;  }
  /**    * Gets f_log_end.  */  public function F_log_end() {    return $this->f_log_end;  }
  /**    * Gets f_log_execution_time.  */  public function F_log_execution_time() {    return $this->f_log_execution_time;  }
  /**    * Gets f_log_source.  */  public function F_log_source() {    return $this->f_log_source;  }
  /**    * Gets f_log_context.  */  public function F_log_context() {    return $this->f_log_context;  }
}