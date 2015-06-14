<?php

/**
 *
 * @package     Easy MVC Framework
 * @author      Jeremie Litzler
 * @copyright   Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * JavascriptManager Class
 *
 * @package       Library
 * @category    Utility
 * @category      
 * @author        Jeremie Litzler
 * @link		
 */

namespace Library\Utility;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class JavascriptManager extends \Library\Core\ApplicationComponent {

  /**
   *
   * @var array $files Javascript files list
   */
  protected $files = array();

  public function __construct(\Library\Core\Application $app) {
    parent::__construct($app);
    $this->files = \Library\Core\DirectoryManager::GetFilesNamesRecursively(
            __ROOT__ . \Library\Enums\ApplicationFolderName::WebJs, "js");
  }

}
