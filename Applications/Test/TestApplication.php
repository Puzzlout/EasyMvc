<?php

/**
* @author Jeremie Litzler
* @copyright Copyright (c) 2015
* @licence http://opensource.org/licenses/gpl-license.php GNU Public License
* @link https://github.com/WebDevJL/EasyMVC
* @since Version 1.0.0
* @package TestApplication
*/


namespace Applications\Test;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class TestApplication extends \Library\Core\Application {

  public function __construct(\Library\Core\ErrorManager $errorManager) {
    parent::__construct($errorManager);

    $this->name = FrameworkConstants_AppName;
    $this->context()->setLanguage();
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
