<?php

/**
 * Class to retrieve the controller files and build a class that holds an array 
 * of controller names.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ControllerListsGenerator
 */

namespace Library\GeneratorEngine\Core;

use Library\Core\DirectoryManager;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ControllerNameConstantsEngine extends ConstantsClassEngineBase {

  /**
   * Retrieve the lists of controller filenames.
   * Generate the Classes that list the Controller names available in the
   * solution.
   * 
   * @param assoc array $data depending on the situation, some data can be passed
   * on to generate the files desired.
   */
  public function Run($data = NULL) {
    $this->ProcessFrameworkData();
    
    $ApplicationList = \Library\GeneratorEngine\Constants\ApplicationList::Init()->GetList();
    foreach ($ApplicationList as $Appname) {
      $this->ProcessApplicationData($Appname);
    }
  }

  private function ProcessFrameworkData() {
    $FrameworkControllers = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir . \Library\Enums\FrameworkFolderName::ControllersFolderName, array("BaseController.php"));

    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "Library\Generated",
        BaseClassGenerator::ClassNameKey => "Framework" . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\FrameworkFolderName::GeneratedFolderName,
        BaseClassGenerator::ClassDescriptionKey => "Lists the constants for framework controller classes to autocompletion and easy coding.",
        ConstantsClassGeneratorBase::DoGenerateConstantKeysKey => TRUE,
        ConstantsClassGeneratorBase::DoGenerateGetListMethodKey => TRUE
    );
    $this->GenerateFrameworkFile($FrameworkControllers);
  }

  /**
   * Generate the files for an app.
   * 
   * @param string $Appname
   */
  function ProcessApplicationData($Appname) {
    $ApplicationControllers = DirectoryManager::GetFileNames(
                    FrameworkConstants_RootDir .
                    \Library\Enums\ApplicationFolderName::AppsFolderName .
                    $Appname .
                    \Library\Enums\ApplicationFolderName::ControllersFolderName);

    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "Applications\\" . $Appname . "\Generated",
        BaseClassGenerator::ClassNameKey => $Appname . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\ApplicationFolderName::AppsFolderName .
        $Appname . \Library\Enums\ApplicationFolderName::Generated,
        BaseClassGenerator::ClassDescriptionKey => "Lists the constants for application controller classes to autocompletion and easy coding.",
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
