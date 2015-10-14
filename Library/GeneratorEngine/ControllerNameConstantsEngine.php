<?php

/**
 * Class to retrieve the controller files and build a class that holds an array 
 * of controller names.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package ControllerListsGenerator
 */

namespace Library\GeneratorEngine;

use Library\Core\DirectoryManager;
use Library\FrameworkConstants;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ControllerNameConstantsEngine extends ConstantsClassEngineBase {

  /**
   * Retrieve the lists of controller filenames.
   * Generate the Classes that list the Controller names available in the
   * solution.
   */
  public function Run() {
    $FrameworkControllers = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir . \Library\Enums\FrameworkFolderName::ControllersFolderName, array("BaseController.php"));

    $ApplicationControllers = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir .
                    \Library\Enums\ApplicationFolderName::AppsFolderName .
                    FrameworkConstants_AppName .
                    \Library\Enums\ApplicationFolderName::ControllersFolderName);

    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "Library\Generated",
        BaseClassGenerator::ClassNameKey => "Framework" . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\FrameworkFolderName::GeneratedFolderName,
        BaseClassGenerator::ClassDescriptionKey => "Lists the constants for framework controller classes to autocompletion and easy coding."
    );
    $this->GenerateFrameworkFile($FrameworkControllers);
    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "Applications\\" . FrameworkConstants_AppName . "\Generated",
        BaseClassGenerator::ClassNameKey => FrameworkConstants_AppName . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\ApplicationFolderName::AppsFolderName .
        FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::Generated,
        BaseClassGenerator::ClassDescriptionKey => "Lists the constants for application controller classes to autocompletion and easy coding."
    );
    $this->GenerateApplicationFile($ApplicationControllers);
  }

}
