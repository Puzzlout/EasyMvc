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
 * TimeLogger Class
 *
 * @package		Library
 * @category	Utility
 * @category	
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Utility;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class TimeLogger extends Logger {

//  public function __construct() {
//    $this->logs[\Library\Enums\ResourceKeys\GlobalAppKeys::log_http_request] = array();
//    $this->logs[\Library\Enums\ResourceKeys\GlobalAppKeys::log_controller_method_request] = array();
//  }

  public static function SetLog($user, \Library\BO\F_log $log) {
    $logs = Logger::GetLogs($user);
    $logs[$log->f_log_type()][$log->f_log_request_id()] = $log;
    Logger::StoreLogs($user, $logs);
  }

  public static function StartLog(\Library\Core\Application $app, $type) {
    $log = new \Library\BO\F_log();
    $log->setF_log_type($type);
    $log->setF_log_request_id($app->httpRequest()->requestId());
    $log->setF_log_start(Logger::GetTime());
    $log->setF_log_filter($app->httpRequest()->requestURI());
    self::SetLog($app->user(), $log);
  }

  public static function EndLog(\Library\Core\Application $app, $type) {
    $logs = Logger::GetLogs($app->user());
    $log = $logs[$type][$app->httpRequest()->requestID()];
    $log->setF_log_end(Logger::GetTime());
    $log->setF_log_execution_time(
            ($log->f_log_end() - $log->f_log_start()) * 1000
    );
    $log->setF_log_start(gmdate("Y-m-d H:i:s", $log->f_log_start()));
    $log->setF_log_end(gmdate("Y-m-d H:i:s", $log->f_log_end()));
    Logger::AddLogToDatabase($app, $log);
    Logger::StoreLogs($app->user(), $logs);
  }

}
