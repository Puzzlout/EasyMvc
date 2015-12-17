<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ArrayFilterFileSearch
 */

namespace Library\Core\FileManager;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ArrayFilterFileSearch extends BaseFileSearch implements \Library\Interfaces\IRecursiveFileTreeSearch {

  /**
   * Builds the instance of class
   * 
   * @return \Library\Core\DirectoryManager\ArrayFilterDirectorySearch
   */
  public static function Init(\Library\Core\Application $app) {
    $instance = new ArrayFilterFileSearch();
    $instance->FileList = array();
    $instance->ContextApp = $app;
    return $instance;
  }

  public function RecursiveFileTreeScanOf($directory, $algorithmFilter) {
    $scanResult = scandir($directory);
    foreach ($scanResult as $key => $value) {
      $includeValueInResult = $this->DoIncludeInResult($value, $algorithmFilter);
      $isValueADirectory = is_file($directory . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR . $value);
      
      if (!$includeValueInResult) {
        continue;
      }
      if ($isValueADirectory) {
        $this->RecursiveScanOf($directory . $value . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR, $algorithmFilter);
      }
      array_push($this->FileList, $directory . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR . $value);
    }
    return $this->DirectoryList;
  }
  
  private function DoIncludeInResult($valueToCheck, $algorithmFilter) {
    foreach ($algorithmFilter as $filter) {
      if(strcmp($valueToCheck, $filter) === 0) {
        return FALSE;
      }
      if(\Library\Helpers\RegexHelper::Init($valueToCheck)->IsMatch('`'.$filter.'`')) {
        return FALSE;
      }
    }
    return TRUE;
  }
}
