<?php

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
    $logs[$log->F_log_id()] = $log;
    Logger::StoreLogs($user, $logs);
  }

  public static function StartLog(\Library\Core\Application $app, $source = NULL, $type = NULL) {
    if (is_null($source)) {
      throw new \Exception("Log must have a source, e.g. __CLASSNAME__.__METHOD__", 0, NULL);//todo: create the error code.
    }
    $log = new \Library\BO\F_log();
    $log->setF_log_id(UUID::v4());
    $log->setF_log_level(is_null($type) ? \Library\BO\F_log_extension::LEVEL_DEBUG : $type);
    $log->setF_log_request_id($app->httpRequest()->requestId());
    $log->setF_log_start(Logger::GetTime());
    $log->setF_log_source($source);
    self::SetLog($app->user(), $log);
    return $log->F_log_id();
  }

  public static function EndLog(\Library\Core\Application $app, $logId, $type = NULL) {
    $type = is_null($type) ? \Library\BO\F_log_extension::LEVEL_DEBUG : $type;
    $logs = Logger::GetLogs($app->user());
    $log = $logs[$logId];
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
