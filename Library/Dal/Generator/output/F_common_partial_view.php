<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2.1* @package F_common_partial_view*/
class F_common_partial_view extends \Library\Core\Entity {  const F_COMMON_PARTIAL_VIEW_ID = "f_common_partial_view_id";  const F_COMMON_PARTIAL_VIEW_FILE_PATH = "f_common_partial_view_file_path";
  protected     $f_common_partial_view_id,    $f_common_partial_view_file_path;
  /**    * Sets f_common_partial_view_id.  */  public function setF_common_partial_view_id($f_common_partial_view_id) {      $this->f_common_partial_view_id = $f_common_partial_view_id;  }
  /**    * Sets f_common_partial_view_file_path.  */  public function setF_common_partial_view_file_path($f_common_partial_view_file_path) {      $this->f_common_partial_view_file_path = $f_common_partial_view_file_path;  }
  /**    * Gets f_common_partial_view_id.  */  public function F_common_partial_view_id() {    return $this->f_common_partial_view_id;  }
  /**    * Gets f_common_partial_view_file_path.  */  public function F_common_partial_view_file_path() {    return $this->f_common_partial_view_file_path;  }
}