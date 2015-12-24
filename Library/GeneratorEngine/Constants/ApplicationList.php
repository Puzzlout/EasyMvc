<?php

/**
 * The file types possible to create in the Web IDE.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ApplicationList
 */

namespace Library\GeneratorEngine\Constants;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ApplicationList {
  
  /***
   * Instantiate the class
   */
  public static function Init() {
    $instance = new ApplicationList();
    return $instance;
  }
  
  /**
   * Retrieve the associative array representing the list of file types.
   * 
   * @return array The Types of file.
   */
  public function GetList() {
    //Get the list of applications in the folder "Applications"
    //$list = scandir(FrameworkConstants_RootDir . \Library\Enums\ApplicationFolderName::AppsFolderName);
    $list = array("EasyMvc", "Ide");
    return $list;
  }
}
