<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package RegexFilterDirectorySearch
 */

namespace Library\Core\DirectoryManager;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class RegexFilterDirectorySearch extends BaseDirectorySearch implements \Library\Interfaces\IRecursiveDirectorySearch {

  public static function Init(\Library\Core\Application $app) {
    $instance = new RegexFilterDirectorySearch();
    $instance->DirectoryList = array();
    $instance->ContextApp = $app;
    return $instance;
  }

  public function RecursiveScanOf($directory, $algorithmFilter) {
    $scanResult = scandir($directory);
    foreach ($scanResult as $key => $value) {
      $includeKeyInResult = \Library\Helpers\RegexHelper::Init($key)->IsMatch($algorithmFilter);
      $includeValueInResult = \Library\Helpers\RegexHelper::Init($value)->IsMatch($algorithmFilter);
      $isValueADirectory = is_dir($directory . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR . $value);
      if (!$includeKeyInResult && !$includeValueInResult) {
        continue;
      }
      if ($isValueADirectory) {
        array_push($this->DirectoryList, $directory . $value . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR);
        $this->RecursiveScanOf($directory . $value . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR, $algorithmFilter);
      }
    }
    return $this->DirectoryList;
  }

}
