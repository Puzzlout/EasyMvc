<?php

/**
 *
 * @package    Easy MVC Framework
 * @author     Jeremie Litzler
 * @copyright  Copyright (c) 2015
 * @license
 * @link
 * @since
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 *
 * LogDal Class
 *
 * @package     Library
 * @category  Dal\Modules
 * @category    LogDal
 * @author      Jeremie Litzler
 * @link
 */

namespace Library\Dal\Modules;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class LogDal extends \Library\Dal\BaseManager {
  //Common implementation is done Library\Dal\BaseManager
}
