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

  public $NamespaceApplicationRootGeneratedFolder = "";
  public $DestinationFolder = "";
  protected $app;

  public function setAppInstance($app) {
    $this->app = $app;
  }

  public function Run($data = NULL) {
    $this->GenerateCommonResxFiles($data[\Library\Core\Globalization::COMMON_RESX_ARRAY_KEY]);
    //$this->GenerateControllerResxFiles($data[\Library\Core\Globalization::CONTROLLER_RESX_ARRAY_KEY]);
  }

  private function GenerateCommonResxFiles($resources) {
    $this->NamespaceApplicationRootGeneratedFolder = "Applications\\" . FrameworkConstants_AppName . "\Ressources\\Common";
    $this->DestinationFolder = \Library\Enums\ApplicationFolderName::AppsFolderName . FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::ResourceCommonFolderName;
    foreach ($resources as $groupKey => $groupArray) {
      foreach ($groupArray as $cultureKey => $cultureArray) {
        $culture = \Library\Helpers\CommonHelper::FindArrayFromAContainingValue($this->app->cultures, \Library\BO\F_culture::F_CULTURE_ID, (string) $cultureKey);
        $this->params = array(
            \Library\GeneratorEngine\BaseClassGenerator::NameSpaceKey => $this->NamespaceApplicationRootGeneratedFolder,
            \Library\GeneratorEngine\BaseClassGenerator::ClassNameKey => $groupKey . $this->GeneratedClassPrefix,
            \Library\GeneratorEngine\BaseClassGenerator::DestinationDirKey => $this->DestinationFolder,
            \Library\GeneratorEngine\BaseClassGenerator::ClassDescriptionKey => "List of the resources for the group" . $groupKey . " of common resources.",
            \Library\GeneratorEngine\BaseClassGenerator::CultureKey => $culture[\Library\BO\F_culture::F_CULTURE_LANGUAGE] . "-" . $culture[\Library\BO\F_culture::F_CULTURE_REGION],
            \Library\GeneratorEngine\BaseClassGenerator::DataIsResources => TRUE
        );
        $this->GenerateApplicationFile($cultureArray);
      }
    }
  }

  private function GenerateControllerResxFiles($resources) {
    $this->NamespaceApplicationRootGeneratedFolder = "Applications\\" . FrameworkConstants_AppName . "\Ressources\\Controller";
    $this->DestinationFolder = \Library\Enums\ApplicationFolderName::AppsFolderName . FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::ResourceControllerFolderName;
    foreach ($resources as $moduleKey => $moduleArray) {
      foreach ($moduleArray as $actionKey => $actionArray) {
        $culture = \Library\Helpers\CommonHelper::FindArrayFromAContainingValue($this->app->cultures, \Library\BO\F_culture::F_CULTURE_ID, (string) $cultureKey);
        $this->params = array(
            \Library\GeneratorEngine\BaseClassGenerator::NameSpaceKey => $this->NamespaceApplicationRootGeneratedFolder,
            \Library\GeneratorEngine\BaseClassGenerator::ClassNameKey => ucfirst($moduleKey),
            \Library\GeneratorEngine\BaseClassGenerator::DestinationDirKey => $this->DestinationFolder,
            \Library\GeneratorEngine\BaseClassGenerator::ClassDescriptionKey => "List of the resources for the module" . $moduleKey,
            \Library\GeneratorEngine\BaseClassGenerator::CultureKey => $culture[\Library\BO\F_culture::F_CULTURE_LANGUAGE] . "-" . $culture[\Library\BO\F_culture::F_CULTURE_REGION],
            \Library\GeneratorEngine\BaseClassGenerator::DataIsResources => TRUE
        );
        $this->GenerateApplicationFile($resources);
      }
    }
  }

}
