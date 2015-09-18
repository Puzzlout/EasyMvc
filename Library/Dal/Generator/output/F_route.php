<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2.1* @package F_route*/
class F_route extends \Library\Core\Entity {  const F_ROUTE_ID = "f_route_id";  const F_ROUTE_URL = "f_route_url";  const F_ROUTE_CONTROLLER = "f_route_controller";  const F_ROUTE_ACTION = "f_route_action";  const F_ROUTE_RESOURCE_KEY = "f_route_resource_key";  const F_ROUTE_TYPE_ID = "f_route_type_id";
  protected     $f_route_id,    $f_route_url,    $f_route_controller,    $f_route_action,    $f_route_resource_key,    $f_route_type_id;
  /**    * Sets f_route_id.  */  public function setF_route_id($f_route_id) {      $this->f_route_id = $f_route_id;  }
  /**    * Sets f_route_url.  */  public function setF_route_url($f_route_url) {      $this->f_route_url = $f_route_url;  }
  /**    * Sets f_route_controller.  */  public function setF_route_controller($f_route_controller) {      $this->f_route_controller = $f_route_controller;  }
  /**    * Sets f_route_action.  */  public function setF_route_action($f_route_action) {      $this->f_route_action = $f_route_action;  }
  /**    * Sets f_route_resource_key.  */  public function setF_route_resource_key($f_route_resource_key) {      $this->f_route_resource_key = $f_route_resource_key;  }
  /**    * Sets f_route_type_id.  */  public function setF_route_type_id($f_route_type_id) {      $this->f_route_type_id = $f_route_type_id;  }
  /**    * Gets f_route_id.  */  public function F_route_id() {    return $this->f_route_id;  }
  /**    * Gets f_route_url.  */  public function F_route_url() {    return $this->f_route_url;  }
  /**    * Gets f_route_controller.  */  public function F_route_controller() {    return $this->f_route_controller;  }
  /**    * Gets f_route_action.  */  public function F_route_action() {    return $this->f_route_action;  }
  /**    * Gets f_route_resource_key.  */  public function F_route_resource_key() {    return $this->f_route_resource_key;  }
  /**    * Gets f_route_type_id.  */  public function F_route_type_id() {    return $this->f_route_type_id;  }
}