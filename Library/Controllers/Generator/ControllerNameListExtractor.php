<?php

/**
 * Class to retrieve the controller files and build an array of controller names.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package ControllerListExtractor
 */

namespace Library\Controllers\Generator;

use Library\Core\DirectoryManager;
use Library\FrameworkConstants;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ControllerNameListExtractor {

  public $filesGenerated = array();
  public function __construct() {
  }

  /**
   * Generate the Classes that list the Controller names available in the
   * solution.
   */
  public function GenerateFiles() {
    $FrameworkControllers = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir .
                    \Library\Enums\FrameworkFolderName::ControllersFolderName);

    $ApplicationControllers = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir .
                    \Library\Enums\ApplicationFolderName::AppsFolderName .
                    FrameworkConstants_AppName .
                    \Library\Enums\ApplicationFolderName::ControllersFolderName);

    array_push($this->filesGenerated, self::GenerateFrameworkControllersArray($FrameworkControllers));
    array_push($this->filesGenerated, self::GenerateFrameworkControllersArray($ApplicationControllers));
  }

  /**
   * Generate the Constant Class list the framework controllers.
   * 
   * @param array(of String) $controllersFiles : the list of framework controllers
   */
  private function GenerateFrameworkControllersArray($controllersFiles) {
    if (count($controllersFiles) > 0) {
      foreach ($controllersFiles as $file) {
        
      }
    }
  }
  /**
   * Generate the Constant Class list the current application controllers.
   * 
   * @param array(of String) $controllersFiles : the list of currnet application controllers
   */
  private function GenerateCurrentApplicationsControllersArray($controllersFiles) {
    if (count($controllersFiles) > 0) {
      foreach ($controllersFiles as $file) {
        
      }
    }
  }

}
