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

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class ControllerNameListExtractor {

  public static function GenerateFile() {
    $FrameworkControllers = DirectoryManager::GetFileNames(
                    FrameworkConstants::FrameworkConstants_RootDir .
                    \Library\Enums\FrameworkFolderName::ControllersFolderName);

    $ApplicationControllers = DirectoryManager::GetFileNames(
                    FrameworkConstants::FrameworkConstants_RootDir .
                    \Library\Enums\ApplicationFolderName::AppsFolderName .
                    FrameworkConstants::FrameworkConstants_AppName .
                    \Library\Enums\ApplicationFolderName::ControllersFolderName);
    
    self::GenerateFrameworkControllersArray($FrameworkControllers);
    self::GenerateFrameworkControllersArray($ApplicationControllers);
  }

  private static function GenerateFrameworkControllersArray($controllersFiles) {
    foreach ($controllersFiles as $file) {
      
    }
  }

  private static function GenerateCurrentApplicationsControllersArray($controllersFiles) {
    foreach ($controllersFiles as $file) {
      
    }
  }

}
