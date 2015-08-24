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
 * ErrorCode Class
 *
 * @package       Library
 * @category    Enums
 * @author        Jeremie Litzler
 * @link		
 */

namespace Library\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class ErrorCode {
  /*
   * Standards HTTP error codes
   */

  const PageNotFound = 404;
  const ServerError = 500;
  /*
   * Application specific error codes
   */
  const ControllerNotExist = 1001;

  /**
   * MySQL Errors => Follow this rule: SQL error code + 1000
   */
  const MySqlAccessDenied = 2045;

}

?>
