<?php

/**
 * Provides a set of functions loading the resources from xml files into an array structure. 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package ResourceLoaderXml
 */

namespace Library\Core\ResourceManagers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ResourceLoaderXml extends ResourceLoaderBase {
    /**
   * Load the resources into each type array.
   * 
   * @param string $sourceToLoad : either ResourceLoaderBase::FROM_FILE or ResourceLoaderBase::FROM_DB
   */
  public function loadResources($sourceToLoad) {
    $this->resoures_path = FrameworkConstants_RootDir . \Library\Enums\ApplicationFolderName::AppsFolderName;
    //Get list of resource files
    $CommonResourceFiles = DirectoryManager::GetFileNames($this->resoures_path . $this->app()->name() . \Library\Enums\ApplicationFolderName::ResourceCommonFolderName);
    $LocalResourceFiles = DirectoryManager::GetFileNames($this->resoures_path . $this->app()->name() . \Library\Enums\ApplicationFolderName::ResourceLocalFolderName);
    //For each resource type, load data into the appropriate array
    foreach ($CommonResourceFiles as $file) {
      $this->loadFile("common", $this->resoures_path . $this->app()->name() . \Library\Enums\ApplicationFolderName::ResourceCommonFolderName . $file);
    }
    foreach ($LocalResourceFiles as $file) {
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
    //Load xml if $filename has the xml 
    if(preg_match("`^.*\.(xml)$`", $filename)) {
    $xml = new \DOMDocument;
    $xml->load($filename);

    //Split file name to use it to store the resources in the array in a organized manner
    $params = $this->prepareParams($filename);
    $params["type"] = $fileResourceType;
    $params["subfolder"] = $this->CurrentSubFolder;
    $this->storeContentsIntoArray($xml->getElementsByTagName('resource'), $params);
    } else {
      //file is not an xml file but a sub folder
      $this->CurrentSubFolder = $filename;
    }
  }

  private function prepareParams($path) {
    $path_to_substr = explode("/", $path);
    $file_to_params = explode(".", $path_to_substr[count($path_to_substr) - 1], -1);
    if (count($file_to_params) <> 2) {
      //todo: create error code
      throw new \Exception("File name is incorrect! The locale is missing. File path given is <" . $path . ">", 0, NULL);
    } else {
      return array("source" => $file_to_params[0], "locale" => $file_to_params[1]);
    }
  }

}
