<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package RegexAlgorithm
 */

namespace Library\Core\DirectoryManager\Algorithms;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class RegexAlgorithm {
  public $RegexForDirectory;
  public $RegexForFile;
}
