<?php

/**
 * Class containing the result of a unit test.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package TestResult
 */

namespace Tests\BO;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class TestResult {
  const SUCCESS = "success";
  const FAIL = "fail";
  
  protected $resultMessage;
  protected $resultStatus = self::FAIL;
  protected $resultTitle;
  protected $resultExecutionTime;
  public $resultStartTime;
  public $resultEndTime;


  public function __construct($message = NULL) {
    $this->resultMessage = isset($message) ? $message : "Not message set";
  }
  
  public function resultStatus() {
    return $this->resultStatus;
  }
  
  public function resultMessage() {
    return $this->resultMessage;
  }
  
  public function resultTitle() {
    return $this->resultTitle;
  }
  
  public function resultExecutionTime() {
    return $this->resultExecutionTime;
  }
  
  public function setResultStatus($resultStatus, $result) {
    if(strcmp($resultStatus, TestResult::SUCCESS) === 0) {
      $this->setResultMessage("");
    } else {
      ob_start();
      var_dump($result);
      $this->setResultMessage(ob_get_clean());
    }
    $this->resultStatus = $resultStatus;
  }
  
  public function setResultMessage($resultMessage) {
    $this->resultMessage = $resultMessage;
  }
  
  public function setResultTitle($resultTitle) {
    $this->resultTitle = $resultTitle;
  }
  
  public function setResultExecutionTime($resultExecutionTime) {
    $this->resultExecutionTime = "Time to execute: " . ($resultExecutionTime * 1000) . "ms";
  }
}