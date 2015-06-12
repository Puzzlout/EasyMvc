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
 * EasyMvcApplication Class
 *
 * @package		Applications\EasyMvc
 * @subpackage	EasyMvcApplication
 * @author		Jeremie Litzler
 * @link		
 */

namespace Applications\EasyMvc;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class EasyMvcApplication extends \Library\Core\Application {

  public function __construct() {
    parent::__construct();

    $this->name = __APPNAME__;
    $this->context()->setLanguage();
    $this->logoImageUrl = $this->imageUtil->getImageUrl($this->config()->get("LogoImageUrl"));
  }

  public function run() {
    \Library\Utility\TimeLogger::StartLog($this, \Library\Enums\ResourceKeys\GlobalAppKeys::log_http_request);
    $this->i8n->loadResources();

    $controller = $this->getController();

    //Get add the Project Manager object to the page
    //The variable PM will be available accross the application
    $this->AddGlobalAppVariables($controller);
    
    $controller->execute();

    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }

  private function AddGlobalAppVariables($controller) {
    $user = $controller->app()->user->getAttribute(\Library\Enums\SessionKeys::UserConnected);
    $controller->page()->addVar('user', $user[0]);
    
    //Just other variables if needed.
  }

}