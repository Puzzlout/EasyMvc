<?php

/**
 * The base of all view model, except the Error VM.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package BaseVm
 */

namespace Library\ViewModels;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class BaseVm implements \Library\Interfaces\IViewModel {

  /**
   * The instance of the Error VM.
   * 
   * @var \Library\ViewModels\Error
   */
  public $errorVm;

  /**
   *
   * @var string
   */
  public $PageTitle = "";

  /**
   *
   * @var array
   */
  public $Resx;

  /**
   * Init the base VM object.
   */
  public function __construct() {
    $this->errorVm = new ErrorVm();
    $this->Resx = $this->GetResources();
  }

  /**
   * Gets the PageTitle.
   * 
   * @return string
   */
  public function PageTitle() {
    return $this->PageTitle;
  }

  /**
   * Sets the PageTitle.
   * 
   * @param string $PageTitle
   */
  public function setPageTitle($PageTitle) {
    $this->PageTitle = $PageTitle;
  }

  public function GetResources() {
    $culture = $this->context()->defaultLang[\Library\BO\F_culture::F_CULTURE_LANGUAGE] .
            "_" .
            $this->context()->defaultLang[\Library\BO\F_culture::F_CULTURE_REGION];

    $resxController = new \Library\Core\ResourceManagers\ControllerResxBase($this);
    $resxController->Instantiate(array(
        \Library\Core\ResourceManagers\ResourceBase::ModuleKey => $this->app()->router()->currentRoute()->module(),
        \Library\Core\ResourceManagers\ResourceBase::ActionKey => $this->app()->router()->currentRoute()->action(),
        \Library\Core\ResourceManagers\ResourceBase::CultureKey => $culture));
    return $resxController;
  }
  
  public static function Copy($VmObject) {
    $VmClassName = get_class($VmObject);
    return new $VmClassName($VmObject);
  }

}
