<?php

/**
 * Provides a set of functions loading the resources from the database.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package ResourceLoaderDatabase
 */

namespace Library\Core\ResourceManagers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ResourceLoaderDatabase extends ResourceLoaderBase {
    /**
   * Load the resources into each type array.
   * 
   * @param string $sourceToLoad : either ResourceLoaderBase::FROM_FILE or ResourceLoaderBase::FROM_DB
   */
  public function loadResources() {
    $CommonResourceFiles = array();
    $LocalResourceFiles = array();
    foreach ($CommonResourceFiles as $resourceGlobal) {
      $this->loadFile("common", $this->resoures_path . $this->app()->name() . \Library\Enums\ApplicationFolderName::ResourceCommonFolderName . $file);
    }
    foreach ($LocalResourceFiles as $resourceLocal) {
      $this->loadFile("local", $this->resoures_path . $this->app()->name() . \Library\Enums\ApplicationFolderName::ResourceLocalFolderName . $file);
    }
  }
    /**
   * Load a resource file.
   * 
   * @param string $fileResourceType : common and local resource
   * @param string $filename : the filename to load
   */
  private function loadFile($fileResourceType, $filename) {
  }

  private function prepareParams($path) {
  }

}
