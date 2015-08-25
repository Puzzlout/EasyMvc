<?php

/**
 *
 * @package      Framework
 * @author      Jeremie Litzler
 * @copyright   Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * ErrorManager Class
 *
 * @package       Library
 * @category    Core
 * @author        Jeremie Litzler
 * @link		
 */

namespace Library\Core;

use Library\Enums\ErrorLoggingMethod;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ErrorManager {

  private $errorLoggingMethod = null;
  private $exception = null;
  private $errorObj = null;

  public function errorObj() {
    return $this->errorObj;
  }

  public function __construct(\Exception $exc, $method = ErrorLoggingMethod::EchoString) {
    $this->errorLoggingMethod = $method;
    $this->exception = $exc;
  }

  public function LogError() {
    switch ($this->errorLoggingMethod) {
      case \Library\Enums\ErrorLoggingMethod::EchoString:
        $this->LogErrorEchoString();
        break;

      default:
        echo "Logging method is " . $this->errorLoggingMethod . " but no implementation is provided for that method yet. Default: EchoString";
        $this->LogErrorEchoString();
        break;
    }
  }

  private function LogErrorEchoString() {
    echo $this->exception->getMessage() . "</br>" . str_replace("#", "</br>#", $this->exception->getTraceAsString());
  }

}
