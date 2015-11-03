<?php

/**
 * Common DateTime operations.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package DateTimeHelper
 */

namespace Library\Utility;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class DateTimeHelper {

  public static function GetDateTimeWithMs($time) {
    $micro = sprintf("%06d", ($time - floor($time)) * 1000000);
    $dateTime = new \DateTime(date('Y-m-d H:i:s.' . $micro, $time));
    $formattedTime = $dateTime->format("Y-m-d H:i:s.u");
    return $formattedTime;
  }

}
