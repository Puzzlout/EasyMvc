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
 * DebugHelper Class
 *
 * @package		Library
 * @category	Utility
 * @category	
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Helpers;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

class DebugHelper {

  /**
   * Print out a string.
   * 
   * @param string $stringData
   */
  public static function WriteString($stringData, $useJson = FALSE) {
    if ($useJson) {
      echo json_encode('{"data":' . $stringData . '}');
    } else {
      echo '<!-- ' . $stringData . ' -->';
    }
  }

  public static function WriteObject($object, $useJson = FALSE) {
    if ($useJson) {
      echo json_encode('{"data":' . var_dump($object) . '}');
    } else {
      echo '<!-- ' . var_dump($object) . ' -->';
    }
    
  }

}
