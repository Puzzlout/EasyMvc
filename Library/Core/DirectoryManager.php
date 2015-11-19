<?php

/**
 *
 * @package     Easy MVC Framework
 * @author      Jeremie Litzler
 * @copyright   Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * DirectoryManager Class
 *
 * @package       Library
 * @category    Core
 * @category      
 * @author        Jeremie Litzler
 * @link		
 */

namespace Library\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class DirectoryManager {

  const DIRECTORY_SEPARATOR = "/";

  /**
   * Get the file paths for the current directory
   * 
   * @param string $dir
   * Directory value to scan.
   * @return array
   * List of files found in directory scanned.
   */
  public static function GetFileNames($dir, $filters = array()) {
    $filenames = array_diff(scandir($dir), array('..', '.'));
    if (count($filters > 0)) {
      $filenames = self::FilterArray($filenames, $filters);
    }
    return $filenames;
  }

  /**
   * 
   * @param type $dirName
   * Directory value to scan.
   * @param type $type
   * File extension to find.
   * @return array(of SplFileInfo)
   * List of SplFileInfo objects scanned in the top-level directory.
   */
  public static function GetFilesNamesRecursively($dirName, $extension = "") {
    $files = self::RecursiveScanDir($dirName);
    return $files;
  }

  public static function RecursiveScanDir($dir) {

    $result = array();

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value) {
      if (!in_array($value, array(".", ".."))) {
        if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
          $result[$value] = self::RecursiveScanDir($dir . DIRECTORY_SEPARATOR . $value);
        } else {
          $result[] = $value;
        }
      }
    }

    return $result;
  }

  /**
   *
   * Create a directory if doesn't exist.
   * Return True if file exists, otherwise False after creation of directory.
   * 
   * @param string
   * $dir Value of directory to create. 
   * @return boolean
   * File exists or not. 
   */
  public static function CreateDirectory($dir) {
    if (!file_exists($dir) && !is_dir($dir)) {
      mkdir($dir, 0777, true);
      return FALSE;
    } else {
      return TRUE;
    }
  }

  /**
   *
   * Check if file exists.
   * Return True if file exists, otherwise False after creation of directory.
   * 
   * @param string
   * $filePath File path 
   * @return boolean
   * File exists or not. 
   */
  public static function FileExists($filePath) {
    if (!file_exists($filePath)) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  /**
   * Filter values out of a given array of values.
   * 
   * @param array (of mixed) $targetArray : the list of values
   * @param array(of mixed) $valuesToRemove : the values to remove from $targetArray
   */
  public static function FilterArray($targetArray, $valuesToRemove) {
    if (is_array($valuesToRemove)) {
      foreach ($valuesToRemove as $value) {
        if (($key = array_search($value, $targetArray)) !== false) {
          unset($targetArray[$key]);
        } else {
          //todo: log that the $value to remove was not found.
        }
      }
    } else {
      //todo: log that the call was made but that $valuesToRemove was not an array.
    }
    return $targetArray;
  }

  /**
   * Get the directory where are stored the Framework views.
   * 
   * @return string The directory
   */
  public static function GetFrameworkRootDir() {
    return \Library\Enums\FrameworkFolderName::ViewsFolderName;
  }

  /**
   * Get the directory where are stored the current Application views.
   * 
   * @return string The directory
   */
  public static function GetApplicationRootDir() {
    return \Library\Enums\ApplicationFolderName::AppsFolderName .
            FrameworkConstants_AppName .
            \Library\Enums\ApplicationFolderName::ViewsFolderName;
  }

}
