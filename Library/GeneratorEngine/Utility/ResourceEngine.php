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

  const CommonClassDerivationNamespace = "\Library\Core\ResourceManagers\CommonResxBase";
  const ControllerClassDerivationNamespace = "\Library\Core\ResourceManagers\ControllerResxBase";

  public $NamespaceApplicationRootGeneratedFolder = "";
  public $DestinationFolder = "";
  protected $app;

  public function setAppInstance($app) {
    $this->app = $app;
  }

  public function Run($data = NULL) {
    $this->PrepareTheDefaultParametersForGeneration(); //todo: put method in Interface.
    $this->GenerateCommonResxFiles($data[\Library\Core\Globalization::COMMON_RESX_ARRAY_KEY]);
    $this->GenerateControllerResxFiles($data[\Library\Core\Globalization::CONTROLLER_RESX_ARRAY_KEY]);
  }

  /**
   * Initialize the property $params with a array key so that we can set value on case per case basis.
   */
  public function PrepareTheDefaultParametersForGeneration() {
    $this->params = array(
        \Library\GeneratorEngine\Core\BaseClassGenerator::NameSpaceKey => NULL,
        \Library\GeneratorEngine\Core\BaseClassGenerator::ClassNameKey => NULL,
        \Library\GeneratorEngine\Core\BaseClassGenerator::DestinationDirKey => NULL,
        \Library\GeneratorEngine\Core\BaseClassGenerator::ClassDescriptionKey => NULL,
        \Library\GeneratorEngine\Core\BaseClassGenerator::CultureKey => NULL,
        \Library\GeneratorEngine\Core\BaseClassGenerator::ClassDerivation => NULL,
        \Library\GeneratorEngine\Core\ConstantsClassGenerator::DoGenerateConstantKeysKey => TRUE,
        \Library\GeneratorEngine\Core\ConstantsClassGenerator::DoGenerateGetListMethodKey => TRUE,
    );
  }

  /**
   * Update the $params based the current context.
   * 
   * @param string $key the resource identification being generated.
   * @param associative array $culture the object F_culture transformed into an array
   */
  public function UpdateTheParametersForGeneration($key, $culture) {
    $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::NameSpaceKey] = $this->NamespaceApplicationRootGeneratedFolder;
    $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::ClassNameKey] = ucfirst($key) . $this->GeneratedClassPrefix;
    $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::DestinationDirKey] = $this->DestinationFolder;
    $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::CultureKey] = is_null($culture) ?
            NULL :
            $culture[\Library\BO\F_culture::F_CULTURE_LANGUAGE] . "_" . $culture[\Library\BO\F_culture::F_CULTURE_REGION];
    if ($this->IsGeneratingBaseClass) {
      $this->params[\Library\GeneratorEngine\Core\ConstantsClassGenerator::DoGenerateConstantKeysKey] = TRUE;
      $this->params[\Library\GeneratorEngine\Core\ConstantsClassGenerator::DoGenerateGetListMethodKey] = FALSE;
    } else {
      $this->params[\Library\GeneratorEngine\Core\ConstantsClassGenerator::DoGenerateConstantKeysKey] = FALSE;
      $this->params[\Library\GeneratorEngine\Core\ConstantsClassGenerator::DoGenerateGetListMethodKey] = TRUE;
    }
  }

  private function GenerateCommonResxFiles($resources) {
    $this->NamespaceApplicationRootGeneratedFolder = "Applications\\" . FrameworkConstants_AppName . "\Resources\\Common";
    $this->DestinationFolder = \Library\Enums\ApplicationFolderName::AppsFolderName . FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::ResourceCommonFolderName;
    foreach ($resources as $groupKey => $groupArray) {
      $this->IsGeneratingBaseClass = TRUE;
      foreach ($groupArray as $cultureKey => $cultureArray) {
        //We need to generate the GroupBase resource file that will hold only the key to query the resources.
        if ($this->IsGeneratingBaseClass) {
          $baseClassNamespace = $this->GenerateCommonBaseClass($groupKey, $cultureArray);
          $this->IsGeneratingBaseClass = FALSE;
        }
        //Then we generate the Group_xx_XX resource file that will list the resources using the base class constant keys.
        $culture = \Library\Helpers\CommonHelper::FindArrayFromAContainingValue($this->app->cultures, \Library\BO\F_culture::F_CULTURE_ID, (string) $cultureKey);
        $this->UpdateTheParametersForGeneration($groupKey, $culture);
        $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::ClassDescriptionKey] = "List of the resources values for the group " . $groupKey;
        $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::ClassDerivation] = $baseClassNamespace;
        $this->GenerateApplicationFile($cultureArray);
      }
    }
  }

  private function GenerateControllerResxFiles($resources) {
    $this->NamespaceApplicationRootGeneratedFolder = "Applications\\" . FrameworkConstants_AppName . "\Resources\\Controller";
    $this->DestinationFolder = \Library\Enums\ApplicationFolderName::AppsFolderName . FrameworkConstants_AppName . \Library\Enums\ApplicationFolderName::ResourceControllerFolderName;
    foreach ($resources as $moduleKey => $moduleArray) {
      $this->IsGeneratingBaseClass = TRUE;
      foreach ($moduleArray as $cultureKey => $cultureArray) {
        if ($this->IsGeneratingBaseClass) {
          $baseClassNamespace = $this->GenerateControllerBaseClass($moduleKey, $cultureArray);
          $this->IsGeneratingBaseClass = FALSE;
        }
        $culture = \Library\Helpers\CommonHelper::FindArrayFromAContainingValue($this->app->cultures, \Library\BO\F_culture::F_CULTURE_ID, (string) $cultureKey);
        $this->UpdateTheParametersForGeneration($moduleKey, $culture);
        $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::ClassDescriptionKey] = "List of the resources values for the module " . $moduleKey;
        $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::ClassDerivation] = $baseClassNamespace;
        $this->GenerateApplicationFile($cultureArray);
      }
    }
  }

  private function GenerateCommonBaseClass($groupKey, $cultureArray) {
    $this->UpdateTheParametersForGeneration($groupKey, NULL);
    $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::ClassDerivation] = NULL;//self::CommonClassDerivationNamespace;
    return $this->GenerateApplicationFile($cultureArray);
  }

  private function GenerateControllerBaseClass($moduleKey, $cultureArray) {
    $this->UpdateTheParametersForGeneration($moduleKey, NULL);
    $this->params[\Library\GeneratorEngine\Core\BaseClassGenerator::ClassDerivation] = NULL;//self::ControllerClassDerivationNamespace;
    return $this->GenerateApplicationFile($cultureArray);
  }

}
