<?php

namespace Tests\MasterClasses;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package DalTests
 */
class DalTests extends BaseTests {

  /**
   * Constructor inits the app and loads the tests from xml file.
   */
  public function __construct() {
    parent::__construct(__CLASS__);
  }

  public function RunTests() {
    foreach ($this->testConfigs() as $testConfig) {
      $testExecution = new \Tests\BO\TestExecution();
      $testResult = $testExecution->setDaoObject($testConfig->daoClassName());
      $testExecution->setJsonData($testConfig->jsonString());
      $testClassInstance = $testExecution->InstanciateObjectFromClassName($testConfig->testClassName(), $this->app(), FALSE);
      $this->ExecuteTest($testConfig, $testExecution, $testResult, $testClassInstance);
    }
  }

  private function ExecuteTest(\Tests\BO\TestConfig $testConfig, \Tests\BO\TestExecution $testExecution, $testResult, $testClassInstance) {
    if ($testClassInstance instanceof \Tests\BO\TestResult && $testResult !== FALSE) {
      $this->ProcessFailedLoadingTest($testConfig, $testResult, $testClassInstance);
    } elseif ($testClassInstance instanceof \Tests\BO\TestResult) {
      $testClassInstance->setResultTitle("DalTest - " . $testConfig->testMethodName());
      $this->AddTestResultToList($testClassInstance);
    } else {
      $this->ProcessTest($testConfig, $testClassInstance);
    }
  }

  private function ProcessFailedLoadingTest(\Tests\BO\TestConfig $testConfig, \Tests\BO\TestResult $testResult, $testClassInstance) {
    $testClassInstance->setResultMessage($testResult->resultMessage() . " ; " . $testClassInstance->resultMessage());
    $testClassInstance->setResultTitle("DalTest - " . $testConfig->testMethodName());
    $this->AddTestResultToList($testClassInstance);
  }

  private function ProcessTest(\Tests\BO\TestConfig $testConfig, $testClassInstance) {
    $testMethodName = $testConfig->testMethodName();
    $iterator = 1;
    $start = microtime(TRUE);
    while ($testConfig->repeat() >= $iterator) {
      $testResult = $testClassInstance->$testMethodName();
      $iterator += 1;
    }
    $end = microtime(TRUE);
    $testResult->setResultExecutionTime($end - $start);
    $testResult->setResultTitle("DalTest - " . $testConfig->testMethodName());
    $this->AddTestResultToList($testResult);
  }

}
