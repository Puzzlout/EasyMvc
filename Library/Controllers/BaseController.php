<?php

/**
 * Base controller to handle request and response from a web browser.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package BaseController
 */

namespace Library\Controllers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class BaseController extends \Library\Core\ApplicationComponent {

  protected $currentRequest = null;
  protected $action = '';
  protected $module = '';
  protected $page = null;
  protected $view = '';
  protected $managers = null;
  protected $resxfile = "";
  protected $resxData = array();
  protected $dataPost = array();
  //shortcut from $app->user() also used as $this->app()->user() in controllers
  protected $user = null;
  protected $files = array();
  protected $toolTips = array();
  
  public $vm;
  
  public function __construct(\Library\Core\Application $app, $module, $action) {
    parent::__construct($app);
    $this->managers = $app->dal();
    $this->page = new \Library\Core\Page($app);
    $this->user = $app->user();
    $this->vm = new \Library\ViewModels\BaseVm($app);
    $this->setModule($module);
    $this->setAction($action);
    $this->setView($action);
    $this->setDataPost($this->app->httpRequest()->retrievePostAjaxData(FALSE));
    $this->setUploadingFiles();
  }

  public function execute() {
    $action = $this->action();
    if (!is_callable(array($this, $action))) {
      //todo: create an error code
      throw new \RuntimeException('The action <b>' . $this->action . '</b> is not defined for the module <b>' . ucfirst($this->module) . '</b>', 0, NULL);
    }
    if ($this->resxfile !== NULL) {
      $this->AddCommonVarsToPage();
    }

    $logGuid = \Library\Utility\TimeLogger::StartLogInfo($this->app(), get_class($this) . "->" . ucfirst($action));
    $viewModelObject = $this->$action();
    \Library\Utility\TimeLogger::EndLog($this->app(), $logGuid);
    return $viewModelObject;
  }

  public function page() {
    return $this->page;
  }

  public function leftMenu() {
    return $this->leftMenu;
  }

  public function managers() {
    return $this->managers;
  }

  public function module() {
    return $this->module;
  }

  public function action() {
    return $this->action;
  }

  public function dataPost() {
    return $this->dataPost;
  }

  /**
   * This is a shortcut to $this->app()->user()
   * 
   * @return \Library\Core\User
   */
  public function user() {
    return $this->user;
  }

  public function files() {
    return $this->files;
  }

  public function toolTips() {
    return $this->toolTips;
  }

  /**
   * Returns the current request.
   * @return \Library\Core\HttpRequest
   */
  public function currentRequest() {
    return $this->currentRequest;
  }

  public function setModule($module) {
    if (!is_string($module) || empty($module)) {
      throw new \InvalidArgumentException('The module value must be a string and not be empty');
    }

    $this->module = $module;
  }

  public function setAction($action) {
    if (!is_string($action) || empty($action)) {
      throw new \InvalidArgumentException('The action value must be a string and not be empty');
    }

    $this->action = $action;
  }

  /**
   * Set the view filename for the current request.
   * 
   * @param string $action the Action from which to build the view filename.
   * @throws \InvalidArgumentException thrown when the $action parameter is null or empty.
   * @todo create a error code.
   */
  public function setView($action) {
    if (!is_string($action) || empty($action)) {
      throw new \InvalidArgumentException('The action value must be a string and not be empty', 0);
    }

    $this->view = $action;

    $this->page->setContentFile(
            FrameworkConstants_RootDir . \Library\Enums\ApplicationFolderName::AppsFolderName
            . $this->app->name()
            . \Library\Enums\ApplicationFolderName::ViewsFolderName
            . ucfirst($this->module)
            . '/'
            . ucfirst($this->view) . '.php');
  }

  public function setDataPost($dataPost) {
    if (!is_array($dataPost) || empty($dataPost)) {
      $this->dataPost = array();
    }

    $this->dataPost = $dataPost;
  }

  public function setUploadingFiles() {
    $this->files = $_FILES;
  }

  /**
   * Sets the current request.
   */
  public function setCurrentRequest() {
    $this->currentRequest = $this->app()->httpRequest();
  }
  

  /**
   * Add the context the variables that are used to generated the output from the Views.
   */
  public function AddGlobalAppVariables() {
    $culture = $this->app->context()->defaultLang[\Library\BO\F_culture::F_CULTURE_LANGUAGE] .
            "_" .
            $this->app->context()->defaultLang[\Library\BO\F_culture::F_CULTURE_REGION];
    $this->page()->addVar('culture', $culture);
    $user = $this->app()->user->getAttribute(\Library\Enums\SessionKeys::UserConnected);
    $this->page()->addVar('user', $user[0]);
    $this->page()->addVar(\Library\Core\Router::CurrentRouteVarKey, $this->app()->router()->currentRoute());
  }

  /**
   * Add to the page object the common variables to use in the views
   * 
   * Variables: none yet
   */
  protected function AddCommonVarsToPage() {
  }

  protected function Redirect($urlPart) {
    $url = FrameworkConstants_BaseUrl . $urlPart;
    header('Location: ' . $url);
    exit();
  }

}
