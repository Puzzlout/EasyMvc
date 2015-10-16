<?php
namespace Library\BO;if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }
/*** @author Jeremie Litzler* @copyright Copyright (c) 2015* @licence http://opensource.org/licenses/gpl-license.php GNU Public License* @link https://github.com/WebDevJL/* @since Version 1.0.2* @package F_culture*/
class F_culture extends \Library\Core\Entity {  const F_CULTURE_ID = "f_culture_id";  const F_CULTURE_LANGUAGE = "f_culture_language";
  const F_CULTURE_REGION = "f_culture_region";
  const F_CULTURE_ISO_639 = "f_culture_iso_639";
  const F_CULTURE_DISPLAY_NAME = "f_culture_display_name";
  protected     $f_culture_id,    $f_culture_language,
    $f_culture_region,
    $f_culture_iso_639,
    $f_culture_display_name;
  /**    * Sets f_culture_id.  */  public function setF_culture_id($f_culture_id) {      $this->f_culture_id = $f_culture_id;  }
  /**    * Sets f_culture_language.  */  public function setF_culture_language($f_culture_language) {      $this->f_culture_language = $f_culture_language;  }

  /**  
  * Sets f_culture_region.
  */
  public function setF_culture_region($f_culture_region) {
      $this->f_culture_region = $f_culture_region;
  }

  /**  
  * Sets f_culture_iso_639.
  */
  public function setF_culture_iso_639($f_culture_iso_639) {
      $this->f_culture_iso_639 = $f_culture_iso_639;
  }

  /**  
  * Sets f_culture_display_name.
  */
  public function setF_culture_display_name($f_culture_display_name) {
      $this->f_culture_display_name = $f_culture_display_name;
  }
  /**    * Gets f_culture_id.  */  public function F_culture_id() {    return $this->f_culture_id;  }
  /**    * Gets f_culture_language.  */  public function F_culture_language() {    return $this->f_culture_language;  }
  /**  
  * Gets f_culture_region.
  */
  public function F_culture_region() {
    return $this->f_culture_region;
  }
  /**  
  * Gets f_culture_iso_639.
  */
  public function F_culture_iso_639() {
    return $this->f_culture_iso_639;
  }

  /**  
  * Gets f_culture_display_name.
  */
  public function F_culture_display_name() {
    return $this->f_culture_display_name;
  }


}