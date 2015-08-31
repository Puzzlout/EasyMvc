<?php

/**
 * List the error codes. 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package ErrorCode
 */

namespace Library\Enums\ErrorCodes;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class FrameworkDal {

  const PrefixMysql = "mysql_";

  public static function GetErrorCodesMySql() {
    return array(
        FrameworkDalConstants::Generic => self::PrefixMysql . FrameworkDalConstants::GenericValue,
    );
  }

  public function GetErrorCodeFromMySqlCode($mysqlCode) {
    $key = self::PrefixMysql . $mysqlCode;
    $codes = self::GetErrorCodesMySql();
    if (array_key_exists($key, $codes)) {
      return $codes[$key];
    } else {
      error_log("MySql exception code not handled. Code => " . $mysqlCode);
      return self::GetGenericErrorCode();
    }
  }
  
  public static function GetGenericErrorCode() {
    return self::PrefixMysql . FrameworkDalConstants::GenericValue;
  }

}
