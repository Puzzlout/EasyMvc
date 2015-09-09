<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2* @package F_route_js*/
class F_route_js extends \Library\Core\Entity {  const F_ROUTE_JS_ID = "f_route_js_id";  const F_ROUTE_JS_FILE_PATH = "f_route_js_file_path";  const F_ROUTE_ID = "f_route_id";
  protected     $f_route_js_id,    $f_route_js_file_path,    $f_route_id;
  /**    * Sets f_route_js_id.  */  public function setF_route_js_id($f_route_js_id) {      $this->f_route_js_id = $f_route_js_id;  }
  /**    * Sets f_route_js_file_path.  */  public function setF_route_js_file_path($f_route_js_file_path) {      $this->f_route_js_file_path = $f_route_js_file_path;  }
  /**    * Sets f_route_id.  */  public function setF_route_id($f_route_id) {      $this->f_route_id = $f_route_id;  }
  /**    * Gets f_route_js_id.  */  public function F_route_js_id() {    return $this->f_route_js_id;  }
  /**    * Gets f_route_js_file_path.  */  public function F_route_js_file_path() {    return $this->f_route_js_file_path;  }
  /**    * Gets f_route_id.  */  public function F_route_id() {    return $this->f_route_id;  }
}