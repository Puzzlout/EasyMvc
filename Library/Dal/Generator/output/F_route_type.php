<?php
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.0.2* @package F_route_type*/
namespace Library\BO;if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) { exit('No direct script access allowed'); }
class F_route_type extends \Library\Core\Entity {  protected     $f_route_type_id,    $f_route_type_description;
  /**    * Sets f_route_type_id.  */  public function setF_route_type_id($f_route_type_id) {      $this->f_route_type_id = $f_route_type_id;  }
  /**    * Sets f_route_type_description.  */  public function setF_route_type_description($f_route_type_description) {      $this->f_route_type_description = $f_route_type_description;  }
  /**    * Gets f_route_type_id.  */  public function F_route_type_id() {    return $this->f_route_type_id;  }
  /**    * Gets f_route_type_description.  */  public function F_route_type_description() {    return $this->f_route_type_description;  }
}