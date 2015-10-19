<?php

/**
* @author Jeremie Litzler
* @copyright Copyright (c) 2015
* @licence http://opensource.org/licenses/gpl-license.php GNU Public License
* @link https://github.com/WebDevJL/EasyMvc
* @since Version 1.0.0
* @package EasyMvcApplication
*/


namespace Applications\EasyMvc;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class EasyMvcApplication extends \Library\Core\Application {

  public function __construct(\Library\Core\ErrorManager $errorManager) {
    parent::__construct($errorManager);

    $this->name = FrameworkConstants_AppName;
    $this->context()->setLanguage();
    $this->logoImageUrl = $this->imageUtil->getImageUrl($this->config()->get(\Library\Enums\AppSettingKeys::LogoImageUrl));
  }

  public function run() {
    $this->i8n->Init(\Library\Core\ResourceManagers\ResourceLoaderBase::FROM_DB);

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
