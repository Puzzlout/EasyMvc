<?php

namespace Tests\MasterClasses;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
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
      $testClassInstance->setResultMessage($testResult->resultMessage() . " ; " . $testClassInstance->resultMessage());
      $testClassInstance->setResultTitle("DalTest - " . $testConfig->testMethodName());
      $this->AddTestResultToList($testClassInstance);
    } elseif ($testClassInstance instanceof \Tests\BO\TestResult) {
      $testClassInstance->setResultTitle("DalTest - " . $testConfig->testMethodName());
      $this->AddTestResultToList($testClassInstance);
    } else {
      $testMethodName = $testConfig->testMethodName();
      $tesDataObject = \Library\Helpers\CommonHelper::PrepareUserObject($testExecution->jsonData(), $testExecution->daoObject());
      $testResult = $testClassInstance->$testMethodName();
      $testResult->setResultTitle("DalTest - " . $testConfig->testMethodName());
      $this->AddTestResultToList($testResult);
    }
  }

}