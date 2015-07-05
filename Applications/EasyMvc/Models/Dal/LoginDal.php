<?php

namespace Applications\EasyMvc\Models\Dal;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed'); }

class LoginDal extends \Library\Dal\BaseManager {

  /**
   * Select a PM from its username or password
   * 
   * @param ProjectManager $pm
   * @return array the selected row in the db
   */
  public function selectOne($user) {
    $emailFilter = \Library\BO\F_user::F_USER_EMAIL;
    $loginFilter = \Library\BO\F_user::F_USER_LOGIN;
    $whereFilter;
    $sql = "SELECT * FROM `" . $this->GetTableName($user)  . "` WHERE ";
    if ($user->F_user_login() !== "") {//Check if the user is giving his username and that there is a value
      $sql .= "`$loginFilter` = :$loginFilter LIMIT 0, 1;";
      $whereFilter = array($loginFilter);
    } else if ($user->F_user_email() !== "") {//Check if the user is giving an email
      $sql .= "`$emailFilter` = :$emailFilter LIMIT 0, 1;";
      $whereFilter = array($emailFilter);
    } else {
      return array();
    }
    $dbConfig = new \Library\Dal\DbStatementConfig($user);
    $dbConfig->setDaoClassName("\Library\BO\F_user");
    $dbConfig->setType(\Library\Dal\DbExecutionType::SELECT);
    $dbConfig->setQuery($sql);
    $this->addDbConfigItem($dbConfig);

       return $this->BindParametersAndExecute($whereFilter, TRUE);
  }

  public function countById($item) {
    
  }

//  public function add($item) {  }

//  public function edit($object, $where_filter_id) {  }

//  public function delete($object, $where_filter_id) {  }

}
