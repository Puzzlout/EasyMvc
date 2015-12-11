<?php

namespace Tests\TestClasses;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package BaseTestClass
 */
class BaseTestClass {

  protected $app;
  protected $testExecution;
  protected $testResult;

  /**
   * Initialize the test class with the current test app and the test execution
   * details.
   * 
   * @param \Applications\Test\TestApplication $app
   * @param \Tests\BO\TestExecution $testExecution
   */
  public function __construct($app, \Tests\BO\TestExecution $testExecution) {
    $this->testExecution = $testExecution;
    $this->app = $app;
    $this->testResult = new \Tests\BO\TestResult();
  }

  protected function AssertIsArray($array) {
    return is_array($array) ? \Tests\BO\TestResult::SUCCESS : \Tests\BO\TestResult::FAIL;
  }
  protected function AssertIsArrayEmpty($array) {
    return count($array) === 0 ? \Tests\BO\TestResult::SUCCESS : \Tests\BO\TestResult::FAIL;
  }
    protected function AssertArrayHasAValue($array) {
    return count($array) === 1 ? \Tests\BO\TestResult::SUCCESS : \Tests\BO\TestResult::FAIL;
  }
  
  }