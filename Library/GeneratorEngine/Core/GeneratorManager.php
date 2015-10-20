<?php

/**
 * Generates files.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/Mvc
 * @since Version 1.0.0
 * @package GeneratorManager
 */

namespace Library\GeneratorEngine\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class GeneratorManager extends \Library\Core\ApplicationComponent {

  /**
   * Generates the Dao classes from a database.
   * 
   * @throws \Exception when there is no table in the schema.
   */
  public function GenerateDaoClasses() {
    $tableList = $this->app()->dal()->getDalInstance()->GetListOfTablesInDatabase();
    if ($tableList > 0) {
      foreach ($tableList as $table) {
        $tableName = $table[0];
        $tableColumnNames = $this->app()->dal()->getDalInstance()->GetTableColumnNames($tableName);
        $tableColumnMetadata = $this->app()->dal()->getDalInstance()->GetTableColumnsMeta($tableName, $tableColumnNames);
        $dao = new \Library\Dal\Generator\DaoClassGenerator($tableName);
        $dao->BuildClassHeader($tableName);
        $dao->BuildClassBody($tableColumnMetadata);
        $dao->ClassEnd();
      }
    } else {
      throw new \Exception("No tables in database!", 0, NULL);
    }
  }

  public function GenerateResourceArrays() {
    $commonResxFromDb = $this->app()->dal()->getDalInstance()->selectMany(new \Library\BO\F_common_resource(), new \Library\Dal\DbQueryFilters());
    $controllerResxFromDb = $this->app()->dal()->getDalInstance()->selectMany(new \Library\BO\F_controller_resource(), new \Library\Dal\DbQueryFilters());

    $generator = new \Library\GeneratorEngine\Utility\ResourceEngine("Resx");
    $generator->Run(array(
        \Library\Core\Globalization::COMMON_RESX_OBJ_LIST => $commonResxFromDb,
        \Library\Core\Globalization::CONTROLLER_RESX_OBJ_LIST => $controllerResxFromDb
    ));

    echo 'Done!';
  }

}
