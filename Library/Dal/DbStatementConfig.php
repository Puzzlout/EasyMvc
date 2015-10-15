<?php

/**
 * Class to prepare to execute the query.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package DbStatementConfig
 */

namespace Library\Dal;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class DbStatementConfig {

  protected $tableName;
  protected $type;
  protected $query;
  protected $daoClassName;
  protected $whereClause = false;
  protected $insertColumnsClause = "";
  protected $insertValuesClause = "";
  protected $updateClause = false;
  protected $selectClause = false;
  protected $joinClause = false;
  protected $orderByClause = false;
  protected $groupByClause = false;
  protected $setClause = false;
  protected $limitClause = false;
  protected $filters;

  public function __construct($daoObject, $queryAction, DbQueryFilters $filters) {
    $this->setDaoObject($daoObject);
    $this->setDaoClassName(\Library\Helpers\CommonHelper::GetFullClassName($daoObject));
    $this->setTableName(\Library\Helpers\CommonHelper::GetShortClassName($daoObject));
    $this->setType($queryAction);
    //$this->BuildSelectClause((array) $daoObject);
    //$this->BuildWhereClause($filters->whereFilters());
    $this->setFilters($filters);
  }

  public function daoObject() {
    return $this->daoObject;
  }

  public function tableName() {
    return $this->tableName;
  }

  public function type() {
    return $this->type;
  }

  public function query() {
    return $this->query;
  }

  public function daoClassName() {
    return $this->daoClassName;
  }

  public function whereClause() {
    return $this->whereClause;
  }

  public function insertColumnsClause() {
    return $this->insertColumnsClause;
  }

  public function insertValuesClause() {
    return $this->insertValuesClause;
  }

  public function updateClause() {
    return $this->updateClause;
  }

  public function selectClause() {
    return $this->selectClause;
  }

  public function joinClause() {
    return $this->joinClause;
  }

  public function orderByClause() {
    return $this->orderByClause;
  }

  public function groupByClause() {
    return $this->groupByClause;
  }

  public function setClause() {
    return $this->setClause;
  }

  public function limitClause() {
    return $this->limitClause;
  }

  public function filters() {
    return $this->filters;
  }

  public function setDaoObject($daoObject) {
    $this->daoObject = $daoObject;
  }

  public function setTableName($tableName) {
    $this->tableName = "`$tableName`";
  }

  public function setType($type) {
    $this->type = $type;
  }

  public function setQuery($query) {
    $this->query = $query;
  }

  public function setDaoClassName($className) {
    $this->daoClassName = $className;
  }

  public function setWhereClause($whereClause) {
    $this->whereClause = $whereClause;
  }

  public function setInsertColumnsClause($insertColumnsClause) {
    $this->insertColumnsClause = $insertColumnsClause;
  }

  public function setInsertValuesClause($insertValuesClause) {
    $this->insertValuesClause = $insertValuesClause;
  }

  public function setUpdateClause($updateClause) {
    $this->updateClause = $updateClause;
  }

  public function setSelectClause($selectClause) {
    $this->selectClause = $selectClause;
  }

  public function setJoinClause($joinClause) {
    $this->joinClause = $joinClause;
  }

  public function setOrderByClause($orderByClause) {
    $this->orderByClause = $orderByClause;
  }

  public function setSetClause($setClause) {
    $this->setClause = $setClause;
  }

  public function setGroupByClause($groupByClause) {
    $this->groupByClause = $groupByClause;
  }

  public function setLimitClause($limitValue) {
    $this->limitClause = "LIMIT 0, $limitValue;";
  }

  public function setFilters($filters) {
    $this->filters = $filters;
  }

  public function BuildSelectClause($selectFilters) {
    if (!$selectFilters) {
      $this->selectClause = FALSE;
      return;
    }

    $this->selectClause = \Library\Dal\DbExecutionType::SELECT . " ";
    foreach ($selectFilters as $filter => $value) {
      $filterClean = str_replace("\0*\0", "", $filter);
      $this->selectClause .= "`$filterClean`, ";
    }
    $this->selectClause = rtrim($this->selectClause);
    $this->selectClause = rtrim($this->selectClause, ",");
  }

  public function BuildWhereClause($whereFilters) {
    if (!$whereFilters) {
      $this->whereClause = FALSE;
      return;
    }

    $this->whereClause = " WHERE ";
    foreach ($whereFilters as $filter) {
      $this->whereClause .= "`$filter` = :$filter, ";
    }
    $this->whereClause = rtrim($this->whereClause);
    $this->whereClause = rtrim($this->whereClause, ",");
  }

  public function BuildOrderClause($orderByFilters) {
    if (!$orderByFilters) {
      $this->orderByClause = FALSE;
      return;
    }

    $this->orderByClause = " ORDER BY ";
    foreach ($orderByFilters as $filter) {
      $this->orderByClause .= "`$filter`, ";
    }
    $this->orderByClause = rtrim($this->orderByClause);
    $this->orderByClause = rtrim($this->orderByClause, ",");
  }

  public function BuildSetClause($setFilters) {
    if (!$setFilters) {
      $this->setClause = FALSE;
      return;
    }

    $this->setClause = "SET ";
    foreach ($setFilters as $filter) {
      $this->selectClause .= "`$filter` = :$filter, ";
    }
    $this->setClause = rtrim($this->setClause);
    $this->setClause = rtrim($this->setClause, ",");
  }

  public function BuildUpdateQuery() {
    $this->query =
            $this->type
            . $this->tableName
            . " SET "
            . $this->updateClause
            . (!$this->whereClause ? "" : $this->whereClause)
            . ";";
  }

  public function BuildInsertQuery() {
    $this->query =
            $this->type
            . " INTO "
            . $this->tableName
            . " ("
            . $this->insertColumnsClause
            . ") VALUES ("
            . $this->insertValuesClause
            . ");";
  }

  public function BuildSelectQuery() {
    $this->query =
            (!$this->selectClause ? "*" : $this->selectClause)
            . " FROM "
            . $this->tableName
            . (!$this->whereClause ? "" : $this->whereClause)
            . (!$this->orderByClause ? "" : $this->orderByClause)
            . ";";
  }

}