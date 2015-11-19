<?php

/**
 * Lists the shared regular expressions used in the Framework and Applications.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package CommonRegexes
 */

namespace Library\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class CommonRegexes {
  const SearchWhiteSpace = "`/\s/`";
  const ResourceKeyValidation = "`^[a-zA-Z0-9_]+$`";
}
