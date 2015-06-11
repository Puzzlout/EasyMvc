<?php

/**
 *
 * @package     EasyMVC Framework
 * @author      Jeremie Litzler
 * @copyright   Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * ErrorManager Class
 *
 * @package       Library
 * @subpackage    Core
 * @author        Jeremie Litzler
 * @link		
 */

namespace Library\Core;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class ErrorManager extends ApplicationComponent{
  private $errorLoggingMethod = null;
  private $exception = null;
  private $errorObj = null;
  
  public function errorObj() {
    return $this->errorObj;
  }
  public function __construct(Application $app, \Exception $exc) {
    parent::__construct($app);
    $this->errorLoggingMethod = $app->config()->get(\Library\Enums\AppSettingKeys::ErrorLoggingMethod);
    $this->exception = $exc;
    $this->errorObj = new \Library\BO\Error();
  }
  
  public function LogError() {
    switch ($this->errorLoggingMethod) {
      case \Library\Enums\ErrorLoggingMethod::EchoString:
        echo $this->exception->getMessage() . "</br>" . str_replace("#", "</br>#", $this->exception->getTraceAsString());
        break;

      default:
        echo "Logging method is " . $this->errorLoggingMethod . " but no implementation is provided for that method yet.";
        break;
    }
  }
}