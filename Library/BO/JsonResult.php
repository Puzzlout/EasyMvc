<?php

/**
 * Class to store a json result.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package JsonResult
 */

namespace Library\BO;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
class JsonResult {

  /**
   * The key of the type in the $State member
   */
  const STATE_TYPE = "stateType";

  const STATE_ERROR = 0;
  const STATE_SUCCESS = 1;
  /**
   * The key of the message in the $State member
   */
  const STATE_MESSAGE = "stateMessage";

  /**
   * @var int The state of the response, whether it was successful or in error. 
   */
  protected $State;
  
  /**
   * @var mixed The result to use in the response.
   */
  protected $Result;
  
  public static function Init() {
      $instance = new JsonResult();
      return $instance;
  }
  
  public function Fill($state, $result) {
      $this->State = $state;
      $this->Result = $result;
      return $this;
  }
}
