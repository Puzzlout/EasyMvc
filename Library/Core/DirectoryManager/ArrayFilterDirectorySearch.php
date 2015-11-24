<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ArrayFilterDirectorySearch
 */

namespace Library\Core\DirectoryManager;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ArrayFilterDirectorySearch extends BaseDirectorySearch implements \Library\Interfaces\IObjectInitialization, \Library\Interfaces\IRecursiveDirectorySearch {

  public static function Init() {
    $instance = new ArrayFilterDirectorySearch();
    $instance->DirectoryList = array();
    return $instance;
  }

  public function RecursiveScanOf($directory, $algorithmFilter) {
    $scanResult = scandir($directory);
    foreach ($scanResult as $key => $value) {
      $includeValueInResult = $this->DoIncludeInResult($value, $algorithmFilter);
      $isValueADirectory = is_dir($directory . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR . $value);
      if (!$includeValueInResult) {
        continue;
      }
      if ($isValueADirectory) {
        array_push($this->DirectoryList, $directory . $value . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR); 
        $this->RecursiveScanOf($directory . $value . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR, $algorithmFilter);
      }
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
