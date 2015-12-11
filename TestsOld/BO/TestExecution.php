<?php

namespace Tests\BO;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

/**
 * Class containing the running details of a unit test. Uses a TestConfig object
 * to instanciate this class to run the test.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package TestExecution
 */
class TestExecution {

  /**
   *
   * @var object : object of type dao class.
   * @see InstanciateObjectFromClassName.
   */
  private $daoObject;

  /**
   *
   * @var string : valid json string containing the json representation of the
   * $objectInstance property.
   */
  private $jsonData;

  /**
   * Gets the object instanciated.
   * @return object
   */
  public function daoObject() {
    return $this->daoObject;
  }

  /**
   * Gets the json data.
   * @return string
   */
  public function jsonData() {
    return $this->jsonData;
  }

  /**
   * Sets the object instance from a given class name.
   * @param type $objectInstance
   * @see InstanciateObjectFromClassName
   */
  public function setDaoObject($daoClassName) {
    $result = $this->InstanciateObjectFromClassName($daoClassName, NULL, TRUE);
    if ($result instanceof TestResult) {
      return $result;
    } else {
      $this->daoObject = $result;
      return FALSE;
    }
  }

  /**
   * Sets the jsonData as a associative array.
   * @param type $jsonData
   */
  public function setJsonData($jsonString) {
    $jsonProcessed = $this->TransformJsonToAssocArray($jsonString);
    $this->jsonData = count($jsonProcessed) === 0 ? FALSE : $jsonProcessed;
  }

  /**
   * Transforms a json string into a associative array.
   * @param type $jsonString
   */
  public function TransformJsonToAssocArray($jsonString) {
    return json_decode($jsonString, TRUE);
  }

  /**
   * Instanciates a object from a class name.
   * 
   * @param string $className : name of class to instantiate.
   * @param \Applications\Test\TestApplication $appInstance : test application instance.
   * @param boolean $isDaoClass : className is Dao type or not.
   * @return \Tests\BO\className : instance of className.
   */
  public function InstanciateObjectFromClassName($className, \Applications\Test\TestApplication $appInstance = NULL, $isDaoClass = FALSE) {
    if (empty($className)) {
      $message =
              $isDaoClass ?
              "Dao class not parametered in the data test xml file" :
              "Test class not parametered in the data test xml file";
      error_log($message);
      $testResult = new TestResult($message);
      $testResult->setResultStatus(TestResult::FAIL);
      return $testResult;
    } elseif (!$isDaoClass) {
      return new $className($appInstance, $this);
    } else {
      return new $className();
    }
  }

}