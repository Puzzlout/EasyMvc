<?php

/**
 * Class to retrieve the dal module files and build a class that holds an array 
 * of dal modules constant names.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package DalModuleNameConstantsGenerator
 */

namespace Library\GeneratorEngine\Core;

use Library\Core\DirectoryManager;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class DalModuleNameConstantsEngine extends ConstantsClassEngineBase {

  /**
   * Retrieve the lists of filenames.
   * Generate the Classes that list the Dal Modules names available in the
   * solution.
   * 
   * @param assoc array $data depending on the situation, some data can be passed
   * on to generate the files desired.
   */
  public function Run($data = NULL) {
    $FrameworkDalModules = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir . \Library\Enums\FrameworkFolderName::DalModulesFolderName);

    $ApplicationDalModules = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir .
                    \Library\Enums\ApplicationFolderName::AppsFolderName .
                    FrameworkConstants_AppName .
                    \Library\Enums\ApplicationFolderName::DalModulesFolderName);

    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "Library\Generated",
        BaseClassGenerator::ClassNameKey => "Framework" . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\FrameworkFolderName::GeneratedFolderName,
        BaseClassGenerator::ClassDescriptionKey => "Lists the constants for framework dal module classes for autocompletion and easy coding."
    );

    $this->GenerateFrameworkFile($FrameworkDalModules);
    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "Applications\\" . FrameworkConstants_AppName . "\Generated",
        BaseClassGenerator::ClassNameKey => FrameworkConstants_AppName . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\ApplicationFolderName::AppsFolderName .
        FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::Generated,
        BaseClassGenerator::ClassDescriptionKey => "Lists the constants for application dal module classes for autocompletion and easy coding."
    );
    $this->GenerateApplicationFile($ApplicationDalModules);
  }

}
