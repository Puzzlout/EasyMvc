<?php

namespace Tests\BO;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

/**
 * Class containing the configuration of a unit test.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package TestConfig
 */
class TestConfig {
  /**
   * Node name of the test node to read.
   */

  const TEST = "test";

  /**
   * Node name of the dao class name to read.
   */
  const DAO_CLASS_NAME = "dao_class_name";
  /**
   * Node name of the class name to read. 
   */
  const TEST_CLASS_NAME = "test_class_name";
  /**
   * Node name of the method name to read. 
   */
  const TEST_METHOD_NAME = "test_method_name";
  /**
   * Node name of the json string to read. 
   */
  const JSONSTR = "json";
/**
 * Node name of the number of time to repeat test value to read.
 */
  const REPEAT = "repeat";
  /**
   *
   * @var object : object of data class.
   */
  private $daoClassName;

  /**
   *
   * @var string : test class instanciated.
   */
  private $testClassName;

  /**
   *
   * @var string : method name to execute in $objectInstance. 
   */
  private $testMethodName;

  /**
   *
   * @var string : valid json string .
   */
  private $jsonString;

  /**
   * Gets the dao class.
   * @return string
   */
  public function daoClassName() {
    return $this->daoClassName;
  }

  /**
   * Gets the test class name.
   * @return string
   */
  public function testClassName() {
    return $this->testClassName;
  }

  /**
   * Gets the test method name.
   * @return string
   */
  public function testMethodName() {
    return $this->testMethodName;
  }

  /**
   * Gets the json data.
   * @return string
   */
  public function jsonString() {
    return $this->jsonString;
  }

  /**
   * Gets the repeat value.
   * @return int
   */
  public function repeat() {
    return $this->repeat;
  }
  
  /**
   * Sets the dao class name.
   * @param string $daoClassName
   */
  public function setDaoClassName($daoClassName) {
    if (empty($daoClassName)) {
      throw new \Exception("Dao class name is empty", -1);
    } else {
      $this->daoClassName = $daoClassName;
    }
  }

  /**
   * Sets the test class name.
   * @param string $testClassName
   */
  public function setTestClassName($testClassName) {
    if (empty($testClassName)) {
      throw new \Exception("Test class name is empty", -1);
    } else {
      $this->testClassName = $testClassName;
    }
  }

  /**
   * Sets the test method name.
   * @param type $testMethodName
   */
  public function setTestMethodName($testMethodName) {
    $this->testMethodName = $testMethodName;
  }

  /**
   * Sets the jsonData as a associative array.
   * @param type $jsonString
   */
  public function setJsonString($jsonString) {
    $this->jsonString = str_replace("'", "\"", $jsonString);
  }

  /**
   * Sets the repeat value as Integer.
   * @param string $repeat
   */
  public function setRepeat($repeat) {
    $this->repeat = empty($repeat) ? 1 : intval($repeat);
  }
  
}