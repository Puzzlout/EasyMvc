<?php

/**
 *
 * @package		Easy MVC Framework
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * GeneratorManager controller Class
 *
 * @package		Library
 * @category	Controllers
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Dal\Generator;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

class GeneratorManager extends \Library\Core\ApplicationComponent {

  public function GenerateDaoClasses() {
    $dal = $this->app()->dal()->getManagerOf("Common", TRUE);
    $tableList = $dal->GetListOfTablesInDatabase();
    if ($tableList > 0) {
      foreach ($tableList as $table) {
        $table_name = $table[0];
        $tableColumnNames = $dal->GetTableColumnNames($table[0]);
        $tableColumnMeta = $dal->GetTableColumnsMeta($table[0], $tableColumnNames);
        $file_name = ucfirst($table_name) . ".php";
        $dao = new DaoClassGenerator(
                array(
                    "file_name" => $file_name, 
                    "dir" => __ROOT__ . "Library/Dal/Generator/output/",
                    "type" => 
                      (strpos($table_name, "c_") !== FALSE ? 
                      \Library\Enums\GenericAppKeys::APP_DB_TABLE : 
                      \Library\Enums\GenericAppKeys::FRAMEWORK_DB_TABLE)
                    )
                );
        $dao->BuildClassHeader($table_name);
        $dao->BuildClassBody($tableColumnMeta);
        $dao->ClassEnd();
      }
    } else {
      throw new Exception("No tables in database!", 0, NULL);
    }
  }
}
