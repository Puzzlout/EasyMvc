<?php

namespace Library\Dal\Modules;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

/**
 * Provides methods to query the database for some generic queries that have
 * nothing to with the database tables.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package CommonDal
 */
class CommonDal extends \Library\Dal\BaseManager {

  /**
   * Gets the list of table names in a database.
   * 
   * @return array The list of table names.
   */
  public function GetListOfTablesInDatabase() {
    $this->dbConfig()->setQuery("SHOW TABLES;");
    $this->dbConfig()->setType(\Library\Dal\DbExecutionType::SHOWTABLES);
    $dbStatement = $this->dao->prepare($this->dbConfig()->query());
    return $this->ExecuteQuery($dbStatement);
  }

  /**
   * Gets the list of column metadata for a table.
   *  
   * @param type $tableName The table name.
   * @param type $columnNames The array of columns.
   * @return array The associative array of the metadata of the table columns.
   */
  public function GetTableColumnsMeta($tableName, $columnNames) {
    $table_columns_meta = array();
    foreach ($columnNames as $columnName) {
      $this->dbConfig()->setQuery("SHOW COLUMNS FROM `$tableName` WHERE Field = '$columnName'");
      $this->dbConfig()->setType(\Library\Dal\DbExecutionType::COLUMNMETAS);
      $dbStatement = $this->dao->prepare($this->dbConfig()->query());
      $table_columns_meta[$columnName] = $this->ExecuteQuery($dbStatement);
    }
    return $table_columns_meta;
  }

  /**
   * Gets the column names for a table.
   * 
   * @param type $tableName The table name
   * @return array The list of column names for a table.
   */
  public function GetTableColumnNames($tableName) {
    $this->dbConfig()->setQuery('DESCRIBE ' . $tableName . ';');
    $this->dbConfig()->setType(\Library\Dal\DbExecutionType::COLUMNNAMES);
    $dbStatement = $this->dao->prepare($this->dbConfig()->query());
    return $this->ExecuteQuery($dbStatement);
  }

}
