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
 * Error Class
 *
 * @package       Library
 * @subpackage    BO
 * @author        Jeremie Litzler
 * @link		
 */

namespace Library\BO;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class Error {

  public
          $errorId = 0,
          $errorType = "",
          $errorDynamicValue = "",
          $errorTitle = "",
          $errorMessage = "";

  //GETTERS
  public function errorId() {
    return $this->errorId;
  }
  public function errorType() {
    return $this->errorType;
  }
  public function errorDynamicValue() {
    return $this->errorDynamicValue;
  }
  public function errorTitle() {
    return $this->errorTitle;
  }
  public function errorMessage() {
    return $this->errorMessage;
  }

  //SETTERS
  public function setErrorId($errorId) {
    $this->errorId = $errorId;
  }
  public function setErrorType($errorType) {
    $this->errorType = $errorType;
  }
  public function setErrorDynamicValue($errorDynamicValue) {
    $this->errorDynamicValue = $errorDynamicValue;
  }
  public function setErrorTitle($errorTitle) {
    $this->errorTitle = $errorTitle;
  }
  public function setErrorMessage($errorMessage) {
    $this->errorMessage = $errorMessage;
  }
  
  /**
   * 
   * @param type $id
   * @param type $type
   * @param type $title
   * @param type $dynamicValue
   */
  public function __construct($id, $type, $title, $message) {
    $this->setErrorId($id);
    $this->setErrorType($type);
    $this->setErrorTitle($title);
    $this->setErrorMessage($message);
  }
}
