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
 * FileNameConst Class
 *
 * @package       Library
 * @category    Enums
 * @category      
 * @author        Jeremie Litzler
 * @link		
 */

namespace Library\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class FileNameConst {

  /**
   * File name suffixes
   */
  const ControllerSuffix = "Controller";
  const Extension = ".php";

  /**
   * File name prefixes
   */
  /*
   * Templates file names
   */
  const LayoutTemplate = "Shared/Layout.php";
  const MenuTopTemplate = "/Templates/menus/top.php";
  const MenuLeftTemplate = "/Templates/menus/left.php";
}
