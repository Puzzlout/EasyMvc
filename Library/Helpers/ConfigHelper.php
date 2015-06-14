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
 * ConfigHelper Class
 *
 * @package		Library
 * @category	Utility
 * @category	
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Helpers;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class ConfigHelper {

  public static function GetValue($caller, $rq, $result) {
    if (!$caller->dataPost()) {
      $dataPost = $caller->dataPost();
      $result[$dataPost["key"]] = $caller->app()->config()->get($dataPost["key"]);
      $result["method"] = \Library\Enums\GenericAppKeys::POST_METHOD;
    }
    if ($rq->getExists("key")) {
      $result[$rq->getData("key")] = $caller->app()->config()->get($rq->getData("key"));
      $result["method"] = \Library\Enums\GenericAppKeys::GET_METHOD;
    }
    return $result;
  }

}
