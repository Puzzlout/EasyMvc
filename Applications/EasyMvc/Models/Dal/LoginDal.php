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
    $sql = "SELECT * FROM " . $this->GetTableName($user)  . " WHERE ";
    if ($user->F_user_login() !== "") {//Check if the user is giving his username and that there is a value
      $sql .= "`f_user_login` = '" . $user->F_user_login() . "' AND `f_user_password` = '" . $user->F_user_password() . "' LIMIT 0, 1;";
    } else if ($user->F_user_email() !== "") {//Check if the user is giving an email
      $sql .= "`f_user_email` = '" . $user->F_user_email() . "' AND `f_user_password` = '" . $user->F_user_password() . "' LIMIT 0, 1;";
    } else {
      return array();
    }
//    \Library\Utility\Logger::PrintOutLogs($sql);
    $query = $this->dao->query($sql);
    $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, "\Library\BO\F_user");

    $userDatabase = $query->fetchAll();
    $query->closeCursor();

    return $userDatabase;
  }

  public function countById($item) {
    
  }

//  public function add($item) {  }

//  public function edit($object, $where_filter_id) {  }

//  public function delete($object, $where_filter_id) {  }

}
