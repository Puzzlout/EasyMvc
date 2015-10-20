<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ResourceHelper
 */

namespace Library\GeneratorEngine\Utility;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ResourceEngine extends \Library\GeneratorEngine\ConstantsClassEngineBase {

  public function Run($data = NULL) {
    $this->GenerateCommonResxFiles($data[\Library\Core\Globalization::COMMON_RESX_OBJ_LIST]);
    $this->GenerateControllerResxFiles($data[\Library\Core\Globalization::CONTROLLER_RESX_OBJ_LIST]);
  }

  private function GenerateCommonResxFiles($resources) {
    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "",
        BaseClassGenerator::ClassNameKey => "CommonResx" . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\ApplicationFolderName::ResourceCommonFolderName,
        BaseClassGenerator::ClassDescriptionKey => "List of the resources for the given module."
    );
    $this->GenerateFrameworkFile($resources);
  }

  private function GenerateControllerResxFiles($resources) {
    $this->params = array(
        BaseClassGenerator::NameSpaceKey => "",
        BaseClassGenerator::ClassNameKey => "ControllerResx" . $this->GeneratedClassPrefix,
        BaseClassGenerator::DestinationDirKey => \Library\Enums\ApplicationFolderName::ResourceControllerFolderName,
        BaseClassGenerator::ClassDescriptionKey => "List of the resources for the given module."
    );
    $this->GenerateFrameworkFile($resources);
  }

}
