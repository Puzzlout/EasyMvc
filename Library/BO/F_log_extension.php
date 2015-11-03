<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.2
 * @package F_log_extension
 */

namespace Library\BO;
if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }

class F_log_extension extends \Library\BO\F_log {
  const LEVEL_INFO = "LEVEL_INFO";
  const LEVEL_DEBUG = "LEVEL_DEBUG";
  const LEVEL_WARNING = "LEVEL_WARNING";
  const LEVEL_ERROR = "LEVEL_ERROR";
  const LEVEL_FATAL = "LEVEL_FATAL";
}