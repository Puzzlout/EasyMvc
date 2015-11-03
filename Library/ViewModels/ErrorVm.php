<?php

/**
 * The view model to store the state of error of the request/response.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ErrorVm
 */

namespace Library\ViewModels;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ErrorVm {
  /**
   *
   * @var int the error identification
   */
  protected $errorId;
  
  /**
   *
   * @var string the error messge extracted from the Common resources for group Error.
   */
  protected $errorMessage;
  
  /**
   *
   * @var \Exception the exception object 
   */
  protected $exceptionObj;
  
  /**
   * Initialize the object
   */
  public function __construct() {
    $this->errorId = 0;
    $this->errorMessage = "N/A";
  }
  
  /**
   * Retrieves the errorId property.
   * 
   * @return int
   */
  public function errorId() {
    return $this->errorId;
  }
  
  /**
   * Retrieves the errorMessage property.
   * 
   * @return string
   */
  public function errorMessage() {
    return $this->errorMessage;
  }
  
  /**
   * Sets the properties of the object
   * 
   * @param int $errorId
   * @param string $errorMessage
   * @param \Exception $exception
   */
  protected function FillInstance($errorId, $errorMessage, $exception) {
    $this->errorId = $errorId;
    $this->errorMessage = $errorMessage;
    $this->exceptionObj = $exception;
  }
}
