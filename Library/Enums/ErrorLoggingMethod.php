<?php

/**
 * List the methods available to log error and information. 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package ErrorLoggingMethod
 */

namespace Library\Enums;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

class ErrorLoggingMethod {

  const EchoString = "error-log-type-echo";
  const Alert = "error-log-type-alert";
  const File = "error-log-type-file";
  const Database = "error-log-type-db";

}
