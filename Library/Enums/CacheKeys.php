<?php

/**
 * List of cache keys.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package CacheKeys
 */

namespace Library\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

abstract class CacheKeys {

  /**
   * Retrieve the list of folders in the solution
   */
  const FrameworkSolutionFolder = "FrameworkSolutionFolder";

}
