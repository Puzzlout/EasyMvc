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
 * @package BaseTests
 */
class BaseTests {

  protected $app;
  protected $testConfigs;
  protected $testResults = array();

  public function __construct($callingChildClass) {
    $errorLogger = new \Library\Core\ErrorManager();
    $this->app = new \Applications\Test\TestApplication($errorLogger);
    $this->LoadTests($callingChildClass);
  }

  /**
   * Gets the test application.
   * @return \Applications\Test\TestApplication
   */
  public function app() {
    return $this->app;
  }

  /**
   * Gets the list of test configs.
   * @return array(of \Tests\BO\TestConfig)
   */
  public function testConfigs() {
    return $this->testConfigs;
  }

  /**
   * Gets the list of test results.
   * @return array(of \Tests\BO\TestResult)
   */
  public function testResults() {
    return $this->testResults;
  }

  /**
   * Loads the tests from the xml file in Tests/DataSamples.
   * 
   * @param string $callingChildClass
   * @return boolean : return FALSE if test data file can't be read.
   */
  private function LoadTests($callingChildClass) {
    if (!$this->testConfigs) {
      $filePath = FrameworkConstants_RootDir . 'Tests/DataSamples/' . substr($callingChildClass, strrpos($callingChildClass, "\\") + 1) . '.xml';
      $xmlReader = new \Library\Core\XmlReader($filePath);
      $tests = $xmlReader->ReturnFileContents(\Tests\BO\TestConfig::TEST);

      $this->testConfigs = array();
      foreach ($tests as $test) {
        try {
          $testClassName = $test->getAttribute(\Tests\BO\TestConfig::TEST_CLASS_NAME);
          $testMethodName = $test->getAttribute(\Tests\BO\TestConfig::TEST_METHOD_NAME);
          $daoClassName = $test->getAttribute(\Tests\BO\TestConfig::DAO_CLASS_NAME);
          $jsonString = $test->getAttribute(\Tests\BO\TestConfig::JSONSTR);
          $repeat = $test->getAttribute(\Tests\BO\TestConfig::REPEAT);
          $testConfig = new \Tests\BO\TestConfig();
          $testConfig->setTestClassName($testClassName);
          $testConfig->setTestMethodName($testMethodName);
          $testConfig->setDaoClassName($daoClassName);
          $testConfig->setJsonString($jsonString);
          $testConfig->setRepeat($repeat);
          array_push($this->testConfigs, $testConfig);
        } catch (\Exception $exc) {
          echo $exc->getMessage() . "<br />" . $exc->getTraceAsString() . "<br />";
        }
      }
    } else {
      return FALSE;
    }
  }

  protected function AddTestResultToList(\Tests\BO\TestResult $testResult) {
    array_push($this->testResults, $testResult);
  }

}