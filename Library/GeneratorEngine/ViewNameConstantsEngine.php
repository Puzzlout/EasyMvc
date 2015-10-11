<?php

/**
 * Class to retrieve the view files and build a class that holds an array 
 * of dal modules constant names.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package ViewNameConstantsEngine
 */

namespace Library\GeneratorEngine;

use Library\Core\DirectoryManager;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ViewNameConstantsEngine extends ConstantsClassEngineBase {
  /**
   * Retrieve the lists of filenames.
   * Generate the Classes that list the Dal Modules names available in the
   * solution.
   */
  public function Run() {
    $FrameworkList = DirectoryManager::GetFilesNamesRecursively(
                    FrameworkConstants_RootDir . \Library\Enums\FrameworkFolderName::ViewsFolderName);

    $ApplicationList = DirectoryManager::GetFilesNamesRecursively(
                    FrameworkConstants_RootDir .
                    \Library\Enums\ApplicationFolderName::AppsFolderName .
                    FrameworkConstants_AppName .
                    \Library\Enums\ApplicationFolderName::ViewsFolderName);

    $this->GenerateFrameworkFile($FrameworkList);
    $this->GenerateApplicationFile($ApplicationList);
  }
}
