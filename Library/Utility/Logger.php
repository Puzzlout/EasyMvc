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
 * Logger Class
 *
 * @package		Library
 * @subpackage	Utility
 * @category	
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Utility;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class Logger {

  public static function StoreLogs($user, $logs) {
    $user->setAttribute("time_live_logs", $logs);
  }

  public static function GetLogs(\Library\Core\User $user) {
    return $user->getAttribute("time_live_logs");
  }

  public static function PrintOutLogs($logs) {
    \Library\Helpers\DebugHelper::LogAsHtmlComment(var_export($logs));
  }

  public static function AddLogToDatabase($app, $log) {
    $db = new \Library\Dal\Managers('PDO', $app);
    $dal = $db->getManagerOf("Log", TRUE);
    $dal->Add($log);
  }

  public static function GetTime() {
    return microtime(true);
  }
  
  public static function LogEx($class, $method, $typeSeparator, $message) {
    throw new \Exception($class . $typeSeparator . $method . " ==> " . $message);
  }

}
