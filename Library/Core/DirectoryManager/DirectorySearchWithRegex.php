<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package DirectorySearchWithRegex
 */

namespace Library\Core\DirectoryManager;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class DirectorySearchWithRegex implements \Library\Interfaces\IRecursiveDirectorySearch {

  public static function Init() {
    $instance = new DirectorySearchWithRegex();
    return $instance;
  }

  public function RecursiveScanOf($directory, $algorithm) {
    $result = array();
    $scanResult = scandir($directory);
    foreach ($scanResult as $key => $value) {
      $includeKeyInResult = \Library\Helpers\RegexHelper::Init($key)->IsMatch($algorithm);
      $includeValueInResult = \Library\Helpers\RegexHelper::Init($value)->IsMatch($algorithm);
      $isValueADirectory = is_dir($directory . \Library\Core\DirectoryManager::DIRECTORY_SEPARATOR . $value);
      if(!$includeKeyInResult || !  $includeValueInResult) {
        continue;
      }
      if ($isValueADirectory) {
        $result[$value] = $this->RecursiveScanOf($directory . DIRECTORY_SEPARATOR . $value, $algorithm);
      } else {
        $result[] = $value;
      }
    }
    return array();
  }

}
