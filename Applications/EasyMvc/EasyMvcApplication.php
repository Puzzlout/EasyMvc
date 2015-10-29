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

class EasyMvcApplication extends \Library\Core\Application implements \Library\Interfaces\IApplication{

  public function __construct(\Library\Core\ErrorManager $errorManager) {
    parent::__construct($errorManager);

    $this->name = FrameworkConstants_AppName;
    $this->context()->setLanguage();
    $this->logoImageUrl = $this->imageUtil->getImageUrl($this->config()->get(\Library\Enums\AppSettingKeys::LogoImageUrl));
  }

  public function run() {
    $controller = $this->getController();

    //Get add the Project Manager object to the page
    //The variable PM will be available accross the application
    $this->AddGlobalAppVariables($controller);

    $controller->execute();

    $this->httpResponse->setPage($controller->page());
    return $this->httpResponse->send();
  }

  private function AddGlobalAppVariables($controller) {
    $controller->page()->addVar(
            'culture', 
            $controller->app()->context()->defaultLang[\Library\BO\F_culture::F_CULTURE_LANGUAGE] . 
            "_" . 
            $controller->app()->context()->defaultLang[\Library\BO\F_culture::F_CULTURE_REGION]);
    
    $user = $controller->app()->user->getAttribute(\Library\Enums\SessionKeys::UserConnected);
    $controller->page()->addVar('user', $user[0]);   
    $controller->page()->addVar(\Library\Core\Router::CurrentRouteVarKey, $controller->app()->router()->currentRoute());
  }

}
