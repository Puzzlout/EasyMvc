<?php

namespace Library\Dal;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

/**
 * Handles the database queries.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package BaseManager
 */
class BaseManager extends \Library\Dal\Manager {

  const INSERTCOLUMNS = "INSERTCOLUMNS";
  const INSERTVALUES = "INSERTVALUES";

  public function __construct($dao, $filters) {
    parent::__construct($dao, $filters);
  }

  /**
   * Select method for one item
   *
   * @param array $item array containing the data to use to build the SQL statement
   */
  public function selectOne($item) {
    
  }

  /**
   * Update method for one item
   *
   * @param array $item array containing the data to use to build the SQL statement
   */
  public function update($item) {
    
  }

  /**
   * Select method for many items
   * 
   * @param object 
   * $object: Dao object
   * @param mixed
   * $where_filter_id: a string or integer value
   * representing the column name to filter the data on. It is used in the WHERE clause.
   * @param bool
   * $filter_as_string: TRUE or FALSE to know if a where filter is a string or a integer 
   * @return mixed
   * Can be a bool (TRUE,FALSE), a integer or a list of Dao objects (of type  $dao_class) 
   */
  public function selectMany($object, $where_filter_id, $filter_as_string = false) {
    $this->dbConfig()->setType(DbExecutionType::SELECT);
    $this->dbConfig()->setDaoClassName(\Library\Helpers\CommonHelper::GetFullClassName($object));
    if ($where_filter_id !== "") {
      $where_clause = " WHERE " . $where_filter_id . " = :where_filter_id";
    } else {
      $where_clause = "";
    }

    $order_by = "";
    if ($object->getOrderByField() !== FALSE) {
      $order_by = "ORDER BY " . $object->getOrderByField();
    }
    $select_clause = "SELECT ";
    foreach ($object as $key => $value) {
      $select_clause .= $key . ", ";
    }
    $select_clause = rtrim($select_clause, ", ");
    $select_clause .= " FROM " . $this->GetTableName($object) . $where_clause . " " . $order_by;
    $sth = $this->dao->prepare($select_clause);
    if ($where_filter_id !== "") {
      if ($filter_as_string) {
        $sth->bindValue(':where_filter_id', $object->$where_filter_id(), \PDO::PARAM_STR);
      } else {
        $sth->bindValue(':where_filter_id', $object->$where_filter_id(), \PDO::PARAM_INT);
      }
    }

    return $this->ExecuteQuery($sth, $params);
  }

  /**
   * 
   * @param type $object
   * @param type $where_filters
   * @return type
   */
  public function selectManyComplex($object, $where_filters) {
    $this->dbConfig()->setType(DbExecutionType::SELECT);
    $this->dbConfig()->setDaoClassName(\Library\Helpers\CommonHelper::GetFullClassName($object));
    $select_clause = "SELECT ";
    //TODO: implement building the where clause with one or many filters
    $where_clause = ""; //$this->BuildWhereClause($where_filters);
    foreach ($object as $key => $value) {
      $select_clause .= $key . ", ";
    }
    $select_clause = rtrim($select_clause, ", ");
    $select_clause.=" FROM " . $this->GetTableName($object);
    $order_by = "";
    if ($object->getOrderByField() !== FALSE) {
      $order_by = "ORDER BY " . $object->getOrderByField();
    }
    $select_clause .= $where_clause . " " . $order_by;

    $sth = $this->dao->prepare($select_clause);
    return $this->ExecuteQuery($sth, $params);
  }

  /**
   * Select method to get a count by id
   *
   * @param int $id
   */
  public function countById($id) {
    
  }

  /**
   * Add method to add a item to DB
   *
   * @param object $item
   */
  public function add($objects) {
    $dbConfigList = array();
    foreach ($objects as $object) {
      $dbConfig = new DbStatementConfig($object);
      $dbConfig->setTableName($this->GetTableName($object));
      $dbConfig->setType(DbExecutionType::INSERT);
      $dbConfig->setInsertColumnsClause($this->BuildClauseStatement($object), array($this::INSERTCOLUMNS));
      $dbConfig->setInsertValuesClause($this->BuildClauseStatement($object), array($this::INSERTVALUES));
      $dbConfig->BuildInsertQuery();
      $this->addDbConfigItem($dbConfig);
    }
    return $this->BindParametersAndExecute(NULL);
  }

  /**
   * Edit method to update a item into DB
   *
   * @param object $item
   */
  public function edit($objects, $whereFilters) {
    $dbConfigList = array();
    foreach ($objects as $object) {
      $dbConfig = new DbStatementConfig($object);
      $dbConfig->setTableName($this->GetTableName($object));
      $dbConfig->setType(DbExecutionType::UPDATE);
      $dbConfig->setUpdateClause($this->BuildClauseStatement($object));
      $dbConfig->setWhereClause($this->BuildClauseStatement($object, $whereFilters));
      $dbConfig->BuildUpdateQuery();
      $this->addDbConfigItem($dbConfig);
    }
    return $this->BindParametersAndExecute($whereFilters);
  }

  /**
   * Add method to delete a item to DB
   *
   * @param int $identifier
   */
  public function delete($object, $where_filter_id) {
    $this->dbConfig()->setTYpe(DbExecutionType::DELETE);
    $delete_clause = "DELETE from `" . $this->GetTableName($object) . "` WHERE $where_filter_id = " . $object->$where_filter_id() . ";";
    $sth = $this->dao->prepare($delete_clause);
    return $this->ExecuteQuery($sth, $params);
  }

  public function GetRoutesDetails($objects) {
    $sql = "";
    foreach ($objects as $object) {
      $tableName = $this->GetTableName($object);
      $sql .= "SELECT " . $this->BuildClauseStatement($object) . " FROM " . $tableName;
    }
    $dbStatement = $this->dao->prepare($sql);
    return $this->ExecuteQuery($dbStatement, array("type" => DbExecutionType::MULTIROWSET));
  }

  /**
   * Builds a clause from a DAO object. 
   * The first condition is to build a SET clause.
   * The second condition is to build a WHERE clause using an array of filters 
   * to limit the clause parameters.
   * The third condition is to build a 
   * @param type $object
   * @param type $filters
   * @return type
   */
  private function BuildClauseStatement($object, $filters = array()) {
    $result = "";
    foreach ((array) $object as $property => $value) {
      $propertyClean = str_replace("\0*\0", "", $property);
      if (count($filters) === 0) {
        $result .= "`$propertyClean` = :$propertyClean,";
      } elseif (count($filters) > 0 && in_array($propertyClean, $filters)) {
        $result .= "`$propertyClean` = :$propertyClean,";
      } elseif (in_array($this::INSERTCOLUMNS, $filters)) {
        $result .= "`$propertyClean`,";
      } elseif (in_array($this::INSERTVALUES, $filters)) {
        $result .= ":$propertyClean,";
      }
    }
    return rtrim($result, ",");
  }

  protected function BindParametersAndExecute($whereFilters = NULL, $skipBinding = FALSE) {
    $allQueries = "";
    foreach ($this->dbConfigList() as $dbConfig) {
      $allQueries .= $dbConfig->query();
    }
    $dbStatement = $this->dao->prepare($allQueries, array(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
    foreach ($this->dbConfigList() as $dbConfig) {
      foreach ((array) $dbConfig->daoObject() as $property => $value) {
        $propertyClean = str_replace("\0*\0", "", $property);
        if (!is_null($whereFilters) && (in_array($propertyClean, $whereFilters) || in_array($propertyClean, $whereFilters))) {
          $dbStatement->bindValue(":$propertyClean", $value);
        } elseif (!$skipBinding) {
          $dbStatement->bindValue(":$propertyClean", $value);
        }
      }
    }
    return $this->ExecuteQuery($dbStatement);
  }

  protected function GetTableName($object) {
    return \Library\Helpers\CommonHelper::GetShortClassName($object);
  }

  protected function ExecuteQuery(\PDOStatement $dbStatement) {
    $result = -2;
    try {
      //$dbStatement->setFetchMode(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY);
      $query = $dbStatement->execute();
      if (!$query) {
        $result = $query->errorCode();
      } else {
        $result = $this->ManageExecutionResult($dbStatement);
      }
    } catch (\PDOException $exception) {
      json_encode($exception);
      //echo "<!--" . $pdo_ex->getMessage() . "-->";
      $result .= $exception->getCode();
    }
    return $result;
  }

  private function ManageExecutionResult(\PDOStatement $dbStatement) {
    $result = array();
    $isValid = true;
    foreach ($this->dbConfigList() as $dbConfig) {
      if (!$isValid) {
        break;
      } elseif ($this->CheckType($dbConfig->type(), DbExecutionType::SELECT)) {
        $dbStatement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $dbConfig->daoClassName());
        $list = $dbStatement->fetchAll();
        $result = count($list) > 0 ? $list : array();
      } elseif ($this->CheckType($dbConfig->type(), DbExecutionType::UPDATE)) {
        $result = TRUE;
      } elseif ($this->CheckType($dbConfig->type(), DbExecutionType::INSERT)) {
        $result = $this->dao->lastInsertId();
      } elseif ($this->CheckType($dbConfig->type(), DbExecutionType::SHOWTABLES)) {
        $result = $dbStatement->fetchAll(\PDO::FETCH_NUM);
      } elseif ($this->CheckType($dbConfig->type(), DbExecutionType::COLUMNNAMES)) {
        $result = $dbStatement->fetchAll(\PDO::FETCH_COLUMN);
      } elseif ($this->CheckType($dbConfig->type(), DbExecutionType::COLUMNMETAS)) {
        $result = $dbStatement->fetch(\PDO::FETCH_ASSOC);
      } elseif ($this->CheckType($dbConfig->type(), DbExecutionType::MULTIROWSET)) {
        //TODO: to implement.
        $isValid = $dbStatement->nextRowset();
      }
    }
    $dbStatement->closeCursor();
    return $result;
  }

  private function CheckType($typeGiven, $typeToMatch) {
    return strcmp($typeGiven, $typeToMatch) === 0;
  }

}
