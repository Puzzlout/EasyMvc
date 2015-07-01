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

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

class DirectoryManager {

  /**
   * Get the file paths for the current directory
   * 
   * @param string $dir
   * Directory value to scan.
   * @return array
   * List of files found in directory scanned.
   */
  public static function GetFileNames($dir) {
    return array_diff(scandir($dir), array('..', '.'));
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
  public static function GetFilesNamesRecursively($dirName, $extension) {
    $files = array();
    $dir_iterator = new \RecursiveDirectoryIterator($dirName);
    $iterator = new \RecursiveIteratorIterator($dir_iterator, \RecursiveIteratorIterator::SELF_FIRST);
    foreach ($iterator as $file) {
      if (preg_match('~^.*' . $extension . '$~', $file->getFileName())) {
        array_push($files, $file);
      }
    }
    return $files;
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

}
