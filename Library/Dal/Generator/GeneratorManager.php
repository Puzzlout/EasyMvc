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
        $file_name = __ROOT__ . "Library/Dal/Generator/output/" . ucfirst($table_name) . ".php";
        echo $file_name . "<br />";
        $dao = new DaoClassGenerator(array("file_name" => $file_name));
        $this->BuildClassHeader($dao, $table_name);
        $this->BuildClassBody($dao, $tableColumnMeta);
        $dao->ClassEnd();
      }
    } else {
      throw new Exception("No tables in database!", 0, NULL);
    }
  }

  private function BuildClassHeader($dao, $table_name) {
    $dao->OpenWriter(array("file_name" => "output/" . ucfirst($table_name) . ".php"));
    $dao->AddPhpOpenTag();
    $dao->AddFileDescription($table_name);
    $dao->AddNameSpace("Applications\PMTool\Models\Dao");
    $dao->AddScriptNotAllowedLine();
    $dao->ClassStart(array("class_name" => $table_name, "base_class" => "\Library\Entity"));
  }

  private function BuildClassBody(\generators\dao_gen $dao, $table_col_metas) {
    //Build the properties
    $dao->AddPropertiesAndConsts($table_col_metas);
    //Add setters
    $dao->AddSetters($table_col_metas);
    //Add getters
    $dao->AddGetters($table_col_metas);
  }

}
