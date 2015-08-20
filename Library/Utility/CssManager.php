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
 * CssManager Class
 *
 * @package       Library
 * @category    Utility
 * @category      
 * @author        Jeremie Litzler
 * @link		
 */

namespace Library\Utility;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class CssManager extends \Library\Core\ApplicationComponent {

  /**
   *
   * @var array $files CSS files list
   */
  protected $files = array();

  public function __construct(\Library\Core\Application $app) {
    parent::__construct($app);
  }

}
