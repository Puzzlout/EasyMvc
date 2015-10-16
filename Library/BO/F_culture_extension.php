<?php

/**
 * Controllers to manage the different authentication methods (login, logout, etc.)
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.2
 * @package F_culture_extension
 */

namespace Library\BO;
if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }

class F_culture_extension extends \Library\BO\F_culture {
  const CultureArrayKey = "culture_";
}