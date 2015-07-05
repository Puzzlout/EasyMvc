<?php

namespace Library\Dal\Generator;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

/**
 * Generates the DAO Classes from a database schema.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package GeneratorManager
 */
class GeneratorManager extends \Library\Core\ApplicationComponent {

  /**
   * Generates the Dao classes from a database.
   * 
   * @throws \Exception
   */
  public function GenerateDaoClasses() {
    $tableList = $this->app()->dal()->getDalInstance()->GetListOfTablesInDatabase();
    if ($tableList > 0) {
      foreach ($tableList as $table) {
        $tableName = $table[0];
        $tableColumnNames = $this->app()->dal()->getDalInstance()->GetTableColumnNames($tableName);
        $tableColumnMetadata = $this->app()->dal()->getDalInstance()->GetTableColumnsMeta($tableName, $tableColumnNames);
        $dao = new DaoClassGenerator($tableName);
        $dao->BuildClassHeader($tableName);
        $dao->BuildClassBody($tableColumnMetadata);
        $dao->ClassEnd();
        
      }
    } else {
      throw new \Exception("No tables in database!", 0, NULL);
    }
  }
}
