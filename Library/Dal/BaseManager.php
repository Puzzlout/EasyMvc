<?php

namespace Library\Dal;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

/**
 * Handles the database queries.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
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
  public function selectMany($object, DbQueryFilters $filters) {
    $dbConfig = new DbStatementConfig($object, DbExecutionType::SELECT, $filters);
    $dbConfig->setType(DbExecutionType::SELECT);
    $dbConfig->setDaoClassName(\Library\Helpers\CommonHelper::GetFullClassName($object));
    $dbConfig->BuildSelectClause(!$filters->selectFilters() ? (array) $object : $filters->selectFilters());
    $dbConfig->BuildWhereClause($filters->whereFilters());
    $dbConfig->BuildOrderClause($filters->orderByFilters());
    $dbConfig->BuildSelectQuery();
    $this->addDbConfigItem($dbConfig);
    return $this->BindParametersAndExecute();
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
      $dbConfig->Bui($this->BuildClauseStatement($object));
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

  protected function BindParametersAndExecute($skipBinding = FALSE) {
    $allQueries = "";
    foreach ($this->dbConfigList() as $dbConfig) {
      $allQueries .= $dbConfig->query();
    }
    $dbStatement = $this->dao->prepare($allQueries, array(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
    foreach ($this->dbConfigList() as $dbConfig) {
      foreach ((array) $dbConfig->daoObject() as $property => $value) {
        $propertyClean = str_replace("\0*\0", "", $property);
        if ($this->IsPropertyNameAFilter($propertyClean, $dbConfig->filters())) {
          $dbStatement->bindValue(":$propertyClean", $value);
        } elseif (!$skipBinding) {
          $dbStatement->bindValue(":$propertyClean", $value);
        }
      }
    }
    //$this->setDbConfigList(NULL);
    return $this->ExecuteQuery($dbStatement);
  }

  private function IsPropertyNameAFilter($propertyName, DbQueryFilters $filters) {
    if (is_array($filters->whereFilters()) && count($filters->whereFilters()) > 0) {
      return in_array($propertyName, $filters->whereFilters());
    } else if (is_array($filters->setFilters()) && count($filters->setFilters()) > 0) {
      return in_array($propertyName, $filters->setFilters());
    } else {
      return FALSE;
    }
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
