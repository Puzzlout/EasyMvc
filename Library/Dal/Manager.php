<?php

namespace Library\Dal;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

abstract class Manager {

  protected $dao;
  protected $dbConfig;
  protected $filters;

  public function __construct($dao, $filters) {
    $this->dao = $dao;
    $this->filters = $filters;
    $this->dbConfig = new DbStatementConfig();
  }

  public function dbConfig() {
    return $this->dbConfig;
  }
  
  public function setDbConfig($dbConfig) {
    $this->dbConfig = $dbConfig;
  }
}
