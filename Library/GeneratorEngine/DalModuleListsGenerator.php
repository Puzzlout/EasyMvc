<?php

/**
 * Class to retrieve the dal module files and build a class that holds an array 
 * of dal modules constant names.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package DalModuleListsGenerator
 */

namespace Library\GeneratorEngine;

use Library\Core\DirectoryManager;
use Library\FrameworkConstants;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class DalModuleListsGenerator {

  const GeneratedPrefix = "DalModules";
  
  public $filesGenerated = array();

  public function __construct() {
    
  }

  /**
   * Retrieve the lists of controller filenames.
   * Generate the Classes that list the Controller names available in the
   * solution.
   */
  public function Run() {
    $FrameworkDalModules = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir . \Library\Enums\FrameworkFolderName::DalModulesFolderName);

    $ApplicationDalModules = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir .
                    \Library\Enums\ApplicationFolderName::AppsFolderName .
                    FrameworkConstants_AppName .
                    \Library\Enums\ApplicationFolderName::DalModulesFolderName);

    $this->GenerateFrameworkFile($FrameworkDalModules);
    $this->GenerateApplicationFile($ApplicationDalModules);
  }

  /**
   * Generate the Constant Class list the framework controllers.
   * 
   * @param assoc array $params : the params composed the namespace and name of the class.
   * @param array(of String) $controllersFiles : the list of framework controllers
   */
  private function GenerateControllersArrayFile($params, $controllerFiles) {
    if (count($controllerFiles) > 0) {
      $classGen = new ClassGeneratorForControllerList(
              FrameworkConstants_RootDir . $params[ClassGenerationBase::DestinationDirKey], $params, $controllerFiles);
      $classGen->BuildClass();
      return $classGen->fileName;
    } else {
      return "No class to generate.";
    }
  }

  /**
   * Generate the FrameworkControllers.php class.
   * 
   * @param array $files : list of dal modules filenames
   */
  private function GenerateFrameworkFile($files) {
    $params = array(
        ClassGenerationBase::NameSpaceKey => "Library\Generated",
        ClassGenerationBase::ClassNameKey => "Framework" . self::GeneratedPrefix,
        ClassGenerationBase::DestinationDirKey => \Library\Enums\FrameworkFolderName::GeneratedFolderName,
    );
    array_push($this->filesGenerated, self::GenerateControllersArrayFile($params, $files));
  }

  /**
   * Generate the AppNameControllers.php class.
   * 
   * @param array $files : list of dal modules filenames
   */
  private function GenerateApplicationFile($files) {
    $params = array(
        ClassGenerationBase::NameSpaceKey => "Applications\\" . FrameworkConstants_AppName . "\Generated",
        ClassGenerationBase::ClassNameKey => FrameworkConstants_AppName . self::GeneratedPrefix,
        ClassGenerationBase::DestinationDirKey => \Library\Enums\ApplicationFolderName::AppsFolderName .
        FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::Generated,
    );
    array_push($this->filesGenerated, self::GenerateControllersArrayFile($params, $files));
  }

}
