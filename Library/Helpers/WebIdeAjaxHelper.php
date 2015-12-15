<?php

/**
 * Provides functions used by its controller, e.g. WebIdeAjaxController.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package WebIdeAjaxHelper
 */

namespace Library\Helpers;

use Library\Core\DirectoryManager\ArrayFilterDirectorySearch;
use Library\Enums\CacheKeys;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class WebIdeAjaxHelper {

  private $ListItemArray;

  public static function Init() {
    $helper = new WebIdeAjaxHelper();
    return $helper;
  }

  /**
   * Retrieves the solution directory list. It caches the result if not already
   * done so that it retrieves it faster the next occurrences.
   * 
   * @param \Library\Core\Application $app The current application instance.
   * @return array(of String)
   */
  public function GetSolutionDirectoryList(\Library\Core\Application $app) {
    $Cacher = \Library\Core\Cache\BaseCache::Init($app->config);
    //$Cacher->Remove(CacheKeys::SOLUTION_FOLDERS);
    if (!$Cacher->KeyExists(CacheKeys::SOLUTION_FOLDERS)) {
      $SolutionPathListArray = ArrayFilterDirectorySearch::Init($this->app())->RecursiveScanOf(
              FrameworkConstants_RootDir, \Library\Core\DirectoryManager\Algorithms\ArrayListAlgorithm::ExcludeList());
      $Cacher->Create(CacheKeys::SOLUTION_FOLDERS, $SolutionPathListArray);
    } else {
      $SolutionPathListArray = $Cacher->Read(CacheKeys::SOLUTION_FOLDERS, array());
    }
    return $SolutionPathListArray;
  }
  
  public function GetSolutionFilesOnly(\Library\Core\Application $app) {
    $Cacher = \Library\Core\Cache\BaseCache::Init($app->config);
    //$Cacher->Remove(CacheKeys::SOLUTION_CLASSES);
    if (!$Cacher->KeyExists(CacheKeys::SOLUTION_CLASSES)) {
      $ArrayResult = \Library\Core\FileManager\ArrayFilterFileSearch::Init($app)->RecursiveFileTreeScanOf(
              FrameworkConstants_RootDir . \Library\Enums\FrameworkFolderName::CORE, \Library\Core\FileManager\Algorithms\ArrayListAlgorithm::ExcludeList());
      $Cacher->Create(CacheKeys::SOLUTION_CLASSES, $ArrayResult);
    } else {
      $ArrayResult = $Cacher->Read(CacheKeys::SOLUTION_CLASSES, array());
    }
    return $ArrayResult;
  }

  /**
   * Extracts from the $FolderPathArray a list of ListItem objects that match 
   * the regexFilter.
   * 
   * @param array $FolderPathArray The array of folder to extract the values from
   * @param string $regexFilter The regex to test each folder path
   * @return array(of \Library\BO\ListItem) The array of ListIem objects ready
   */
  public function ExtractListItemsFrom($FolderPathArray, $regexFilter) {
    $this->ListItemArray = array();
    foreach ($FolderPathArray as $key => $path) {
      if ($this->IsFolderMatchingFilter($path, $regexFilter)) {
        $this->AddFolderPathToListItems($key, $path);
      }
    }
    return $this->ListItemArray;
  }

  /**
   * Test to the path against the filter.
   * 
   * @param string $path The folder path
   * @param string $regexFilter The regex to test the path 
   */
  public function IsFolderMatchingFilter($path, $regexFilter) {
    return \Library\Helpers\RegexHelper::Init($path)->IsMatch($regexFilter);
  }

  /**
   * Add a ListItem object to the field ListItemArray.
   * 
   * @param type $key
   * @param string $path The folder path
   */
  public function AddFolderPathToListItems($key, $path) {
    array_push($this->ListItemArray, \Library\BO\ListItem::Init($key, $path));
  }

  /**
   * Builds a regex value using a filter found in $dataPost array. If not found,
   * it return the regex that matches any string.
   * 
   * @param array $dataPost The $_POST array
   * @return string The regex computed.
   */
  public function GetFilterRegex($dataPost) {
    $filterKey = "filter";
    if (array_key_exists($filterKey, $dataPost)) {
      $filterRegex = '`.*' . $dataPost[$filterKey] . '.*$`';
      return $filterRegex;
    } 
    
    $filterRegex = '`^.*$`';
    return $filterRegex;
  }

}
