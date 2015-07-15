<?php

namespace Tests\TestClasses;

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
 * @package LoginDalTest
 */
class LoginDalTest extends BaseTestClass {
  public function SelectOneUserFromId() {
    if(!$this->testExecution->jsonData()) {
      $user = \Library\Helpers\CommonHelper::PrepareUserObject(\Tests\DataSamples\LoginDalTestsData::SelectASingleUserNeverWhoLoggedIn(), $this->testExecution->daoObject());
    } else {
      $user = $this->testExecution->daoObject();
    }
    
    $result = $this->app->dal()->getDalInstance("Login")->SelectOne($user, array(\Library\BO\F_user::F_USER_ID));
    $testResult = new \Tests\BO\TestResult();
    
    $testResult->setResultStatus(count($result) === 1 ? \Tests\BO\TestResult::SUCCESS : \Tests\BO\TestResult::FAIL);
    $testResult->setResultMessage(strcmp($testResult->resultStatus(), \Tests\BO\TestResult::SUCCESS) === 0 ? "One user was found" : "No user was found");
    return $testResult;
  }
}