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

namespace Library\Generators;

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
                    FrameworkConstants_RootDir . \Library\Enums\FrameworkFolderName::ControllersFolderName,
            array("BaseController.php"));

    $ApplicationControllers = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir .
                    \Library\Enums\ApplicationFolderName::AppsFolderName .
                    FrameworkConstants_AppName .
                    \Library\Enums\ApplicationFolderName::ControllersFolderName);

    $params = array(
        ClassGenerationBase::NameSpaceKey => "Library\Generated",
        ClassGenerationBase::ClassNameKey => "FrameworkControllers",
        ClassGenerationBase::DestinationDirKey => \Library\Enums\FrameworkFolderName::GeneratedFolderName,
    );
    array_push($this->filesGenerated, self::GenerateControllersArrayFile($params, $FrameworkControllers));
    $params[ClassGenerationBase::NameSpaceKey] = "Applications\\" . FrameworkConstants_AppName . "\Generated";
    $params[ClassGenerationBase::ClassNameKey] = FrameworkConstants_AppName . "Controllers";
    $params[ClassGenerationBase::DestinationDirKey] = \Library\Enums\ApplicationFolderName::AppsFolderName .
            FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::Generated;
    array_push($this->filesGenerated, self::GenerateControllersArrayFile($params, $ApplicationControllers));
  }

  /**
   * Generate the Constant Class list the framework controllers.
   * 
   * @param assoc array $params : the params composed the namespace and name of the class.
   * @param array(of String) $controllersFiles : the list of framework controllers
   */
  private function GenerateControllersArrayFile($params, $controllersFiles) {
    if (count($controllersFiles) > 0) {
      $classGen = new ClassGenerationControllerNamesArray(
              FrameworkConstants_RootDir . $params[ClassGenerationBase::DestinationDirKey], $params, $controllersFiles);
      $classGen->BuildClass();
      return $classGen->fileName;
    } else {
      return "Not class to generate.";
    }
  }

}
