<?php

namespace Library\Helpers;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');


/**
 * Retrieve the network info from the $_ENV and $_SERVER global variables. 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package NetworkInfoHelper
 */
class NetworkInfoHelper {
  /**
   * Get the client ip from the environnement. 
   * 
   * @return string
   * The IP address of client. 
   */
  public static function GetClientIpEnvironnement() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
      $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
    else
      $ipaddress = 'UNKNOWN';

    return $ipaddress;
  }
  /**
   * Get the client ip from the server global variable. 
   * 
   * @return string
   * The IP address of client. 
   */
  public static function GetClientIpServer() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_X_FORWARDED'])
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if ($_SERVER['HTTP_FORWARDED_FOR'])
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if ($_SERVER['HTTP_FORWARDED'])
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if ($_SERVER['REMOTE_ADDR'])
      $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
      $ipaddress = 'UNKNOWN';

    return $ipaddress;
  }

}