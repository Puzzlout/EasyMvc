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
    $this->app()->i8n()->Init();
    $generator = new \Library\GeneratorEngine\Utility\ResourceEngine("Resx");
    $generator->setAppInstance($this->app());
    $generator->Run(array(
        \Library\Core\Globalization::COMMON_RESX_ARRAY_KEY => $this->app()->i8n()->CommonResources,
        \Library\Core\Globalization::CONTROLLER_RESX_ARRAY_KEY => $this->app()->i8n()->ControllerResources
    ));

    echo 'Done!';
  }

}
