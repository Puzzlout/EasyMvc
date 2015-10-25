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

class ResourceEngine extends \Library\GeneratorEngine\Core\ResourceConstantsClassEngine {

  public $NamespaceApplicationRootGeneratedFolder = "";
  public $DestinationFolder = "";
  protected $app;

  public function setAppInstance($app) {
    $this->app = $app;
  }

  public function Run($data = NULL) {
    $this->GenerateCommonResxFiles($data[\Library\Core\Globalization::COMMON_RESX_ARRAY_KEY]);
    $this->GenerateControllerResxFiles($data[\Library\Core\Globalization::CONTROLLER_RESX_ARRAY_KEY]);
  }

  private function GenerateCommonResxFiles($resources) {
    $this->NamespaceApplicationRootGeneratedFolder = "Applications\\" . FrameworkConstants_AppName . "\Ressources\\Common";
    $this->DestinationFolder = \Library\Enums\ApplicationFolderName::AppsFolderName . FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::ResourceCommonFolderName;
    foreach ($resources as $groupKey => $groupArray) {
      foreach ($groupArray as $cultureKey => $cultureArray) {
        $culture = \Library\Helpers\CommonHelper::FindArrayFromAContainingValue($this->app->cultures, \Library\BO\F_culture::F_CULTURE_ID, (string) $cultureKey);
        $this->params = array(
            \Library\GeneratorEngine\Core\BaseClassGenerator::NameSpaceKey => $this->NamespaceApplicationRootGeneratedFolder,
            \Library\GeneratorEngine\Core\BaseClassGenerator::ClassNameKey => ucfirst($groupKey) . $this->GeneratedClassPrefix,
            \Library\GeneratorEngine\Core\BaseClassGenerator::DestinationDirKey => $this->DestinationFolder,
            \Library\GeneratorEngine\Core\BaseClassGenerator::ClassDescriptionKey => "List of the resources for the group" . $groupKey . " of common resources.",
            \Library\GeneratorEngine\Core\BaseClassGenerator::CultureKey => $culture[\Library\BO\F_culture::F_CULTURE_LANGUAGE] . "_" . $culture[\Library\BO\F_culture::F_CULTURE_REGION],
            \Library\GeneratorEngine\Core\BaseClassGenerator::ClassDerivation => "\Library\Core\ResourceManagers\CommonResxBase"
        );
        $this->GenerateApplicationFile($cultureArray);
      }
    }
  }

  private function GenerateControllerResxFiles($resources) {
    $this->NamespaceApplicationRootGeneratedFolder = "Applications\\" . FrameworkConstants_AppName . "\Ressources\\Controller";
    $this->DestinationFolder = \Library\Enums\ApplicationFolderName::AppsFolderName . FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::ResourceControllerFolderName;
    foreach ($resources as $moduleKey => $moduleArray) {
      foreach ($moduleArray as $cultureKey => $cultureArray) {
        $culture = \Library\Helpers\CommonHelper::FindArrayFromAContainingValue($this->app->cultures, \Library\BO\F_culture::F_CULTURE_ID, (string) $cultureKey);
        $this->params = array(
            \Library\GeneratorEngine\Core\BaseClassGenerator::NameSpaceKey => $this->NamespaceApplicationRootGeneratedFolder,
            \Library\GeneratorEngine\Core\BaseClassGenerator::ClassNameKey => ucfirst($moduleKey) . $this->GeneratedClassPrefix,
            \Library\GeneratorEngine\Core\BaseClassGenerator::DestinationDirKey => $this->DestinationFolder,
            \Library\GeneratorEngine\Core\BaseClassGenerator::ClassDescriptionKey => "List of the resources for the module" . $moduleKey,
            \Library\GeneratorEngine\Core\BaseClassGenerator::CultureKey => $culture[\Library\BO\F_culture::F_CULTURE_LANGUAGE] . "_" . $culture[\Library\BO\F_culture::F_CULTURE_REGION],
            \Library\GeneratorEngine\Core\BaseClassGenerator::ClassDerivation => "\Library\Core\ResourceManagers\ComntrollerResxBase"
        );
        $this->GenerateApplicationFile($cultureArray);
      }
    }
  }

}
