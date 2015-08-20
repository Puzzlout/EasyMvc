<?php

namespace Library\Dal;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class Manager {

  protected $dao;
  protected $dbConfigList = array();
  protected $filters;

  public function __construct($dao, $filters) {
    $this->dao = $dao;
    $this->filters = $filters;
  }

  public function dbConfigList() {
    return $this->dbConfigList;
  }

  public function addDbConfigItem($dbConfig, $addToList = FALSE) {
    if ($addToList) {
      array_push($this->dbConfigList, $dbConfig);
    } else {
      $this->dbConfigList = array($dbConfig);
    }
   
  }

  public function setDbConfigList($dbConfigList) {
    $this->dbConfigList = $dbConfigList;
  }

}
