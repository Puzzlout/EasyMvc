<?php

/**
 * List the error codes. 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package ErrorCode
 */

namespace Library\Enums\ErrorCodes;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class Http {
  const PageNotFound = 404;
  const ServerError = 500;

}