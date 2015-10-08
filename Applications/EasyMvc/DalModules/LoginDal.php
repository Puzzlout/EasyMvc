<?php

namespace Applications\EasyMvc\DalModules;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class LoginDal extends \Library\Dal\BaseManager {

  /**
   * Select a PM from its username or password
   * 
   * @param ProjectManager $pm
   * @return array the selected row in the db
   */
  public function selectOne($user, \Library\Dal\DbQueryFilters $dbFilters) {
    $dbConfig = new \Library\Dal\DbStatementConfig($user, \Library\Dal\DbExecutionType::SELECT, $dbFilters);
    $dbConfig->setLimitClause(1);
    $dbConfig->BuildSelectQuery();
    $this->addDbConfigItem($dbConfig);

    return $this->BindParametersAndExecute(TRUE);
  }

  public function countById($item) {
    
  }

//  public function add($item) {  }
//  public function edit($object, $where_filter_id) {  }
//  public function delete($object, $where_filter_id) {  }
}
