<?php

/**
 * The view model to store the state of an ajax request/response in JSON objects.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package BaseJsonVm
 */

namespace Library\ViewModels;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class BaseJsonVm extends BaseVm {

  /**
   * The key of the type in the $State member
   */
  const STATE_TYPE = "stateType";

  const STATE_SUCCESS = 1;
  const STATE_ERROR = 2;
  const STATE_WARNING = 3;
  const STATE_INFO = 4;
  /**
   * The key of the message in the $State member
   */
  const STATE_MESSAGE = "stateMessage";

  /**
   *
   * @var mixed The response to use by the JavaScript Client 
   */
  protected $Response;

  /**
   *
   * @var array The state of the request, whether it was successful or if there
   * was an error. It contains the message (Info, success, warning or error) to 
   * display as notification result of the AJAX call.
   */
  protected $State;

  /**
   * Getter for $Response member.
   * 
   * @return mixed
   * @see $Response member
   */
  public function Response() {
    return $this->Response;
  }

  /**
   * Getter for $State member.
   * 
   * @return array
   * @see $State member
   */
  public function State() {
    return $this->State;
  }

  /**
   * Setter for the $State member.
   * 
   * @param int $type The type 
   * @param string $message The message
   */
  public function setState($type, $message) {
    $this->State = array(
        self::STATE_TYPE => $type,
        self::STATE_MESSAGE => $message
    );
  }

}
