<?php

/**
 * Provides an interface to implement a recursive search of a directory to get
 * a list of directories
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package IRecursiveDirectorySearch
 */

namespace Library\Interfaces;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

interface IRecursiveDirectorySearch {
  /**
   * Scan a directory recursively applying an algorithm and return the filtered 
   * resulting list that is an array of following structure:
   * 
   * array(
   *    0 => "Dir1",
   *    "Dir2" => array(
   *      0 => "Dir3",
   *      1 => "Dir4",
   *      2 => "DirN.ext",
   *      "SubDir => array(
   *        0 => "Dir1",
   *        1 => "Dir2",
   *        2 => "DirN.ext",
   *      )
   *    )
   * ).
   * 
   * @param string $directory The directory to scan
   * @param mixed $algorithm The filter to apply to the search
   * @return array
   */
  public function RecursiveScanOf($directory, $algorithm);
}
