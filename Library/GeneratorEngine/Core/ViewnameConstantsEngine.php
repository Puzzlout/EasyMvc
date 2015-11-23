<?php

/**
 * Class to retrieve the view files and build a class that holds all the viewname
 * constants and an array to search one.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package ViewnameConstantsEngine
 */

namespace Library\GeneratorEngine\Core;

use Library\Core\DirectoryManager;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ViewnameConstantsEngine extends ConstantsClassEngineBase {

  /**
   * Retrieve the lists of filenames.
   * Generate the Classes that list the Dal Modules names available in the
   * solution.
   */
  public function Run($data = NULL) {
    $FrameworkList = DirectoryManager::GetFilesNamesRecursively(
                    FrameworkConstants_RootDir . \Library\Enums\FrameworkFolderName::ViewsFolderName);
    $ApplicationList = DirectoryManager::GetFilesNamesRecursively(
                    FrameworkConstants_RootDir .
                    \Library\Enums\ApplicationFolderName::AppsFolderName .
                    FrameworkConstants_AppName .
                    \Library\Enums\ApplicationFolderName::ViewsFolderName);
    $this->InitGenerateFrameworkFile($FrameworkList);
    $this->InitGenerateApplicationFile($ApplicationList);
  }

  function InitGenerateFrameworkFile($FrameworkControllers) {
    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "Library\Generated",
        BaseClassGenerator::ClassNameKey => "Framework" . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\FrameworkFolderName::GeneratedFolderName,
        BaseClassGenerator::ClassDescriptionKey => "Lists the constants for framework viewnames to use for autocompletion and easy coding.",
        ConstantsClassGeneratorBase::DoGenerateConstantKeysKey => TRUE,
        ConstantsClassGeneratorBase::DoGenerateGetListMethodKey => TRUE
    );
    $this->GenerateFrameworkFile($FrameworkControllers);
  }

  function InitGenerateApplicationFile($ApplicationControllers) {
    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "Applications\\" . FrameworkConstants_AppName . "\Generated",
        BaseClassGenerator::ClassNameKey => FrameworkConstants_AppName . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\ApplicationFolderName::AppsFolderName .
        FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::Generated,
        BaseClassGenerator::ClassDescriptionKey => "Lists the constants for application viewnames to use for autocompletion and easy coding.",
        ConstantsClassGeneratorBase::DoGenerateConstantKeysKey => TRUE,
        ConstantsClassGeneratorBase::DoGenerateGetListMethodKey => TRUE
    );
    $this->GenerateApplicationFile($ApplicationControllers);
  }

  /**
   * Generate the Constant Class.
   * 
   * @param array(of String) $data the array of data that will be used to build the list of constants
   */
  protected function GenerateConstantsClass($data) {
    if (count($data) > 0) {
      $classGen = new ConstantsAndListClassGenerator($this->params, $data);
      $classGen->BuildClass();
      return str_replace(".php", "", $classGen->fileName);
    } else {
      return "No class to generate.";
    }
  }

}
