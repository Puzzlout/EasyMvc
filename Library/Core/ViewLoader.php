<?php

/**
 * 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ViewLoader
 */

namespace Library\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ViewLoader implements \Library\Interfaces\IViewLoader {

  /**
   * The extension of a view file.
   */
  const VIEWFILEEXTENSION = ".php";

  /**
   * The controller object to use to look for a view.
   * 
   * @var \Library\Controllers\BaseController $controller The controller object 
   */
  public $controller;

  /**
   * Instanciate the class to find the view filepath.
   * 
   * @param \Library\Controllers\BaseController $controller The controller object
   */
  public function __construct(\Library\Controllers\BaseController $controller) {
    $this->controller = $controller;
  }

  /**
   * Retrieve the view from either the Framework folder or the current Application folder.
   * 
   * @throws \Library\Exceptions\ViewNotFoundException Throws an exception if the view is not found 
   * @see \Library\Core\ViewLoader::GetFrameworkRootDir()
   * @see \Library\Core\ViewLoader::GetApplicationRootDir()
   * @todo create error code.
   */
  public function GetView() {
    $FrameworkView = $this->GetPathForView(self::GetFrameworkRootDir());
    $ApplicationView = $this->GetPathForView(self::GetApplicationRootDir());

    if (file_exists($FrameworkView)) {
      return $FrameworkView;
    } else if (file_exists($ApplicationView)) {
      return $ApplicationView;
    } else {
      throw new \Library\Exceptions\ViewNotFoundException("View " . $FrameworkView . " or " . $ApplicationView . " doesn't exists", 0, NULL);
    }
  }

  /**
   * Retrieve the partial view from either the Framework folder or the current Application folder.
   * 
   * @param string $controller The name of the controller
   * @param string $viewName The name of view to load
   * @throws \Library\Exceptions\ViewNotFoundException Throws an exception if the view is not found 
   * @see \Library\Core\ViewLoader::GetFrameworkRootDir()
   * @see \Library\Core\ViewLoader::GetApplicationRootDir()
   */
  public static function GetPartialView($controller, $viewName) {
    $pathCommonPartialDir = self::GetFrameworkRootDir() . "Modules/";
    $pathSpecificPartialDir = self::GetApplicationRootDir() . $controller . "/Modules/";
    $pathCommonPartialView = $pathCommonPartialDir . $viewName . self::VIEWFILEEXTENSION;
    $pathSpecificPartialView = $pathSpecificPartialDir . $viewName . self::VIEWFILEEXTENSION;
    if (file_exists($pathCommonPartialView)) {
      return $pathCommonPartialView;
    } elseif (file_exists($pathSpecificPartialView)) {
      return $pathSpecificPartialView;
    } else {
      throw new \Library\Exceptions\ViewNotFoundException("Partial view not found in " . $pathCommonPartialDir . " nor " . $pathSpecificPartialDir);
    }
  }

  /**
   * Computes the path of the view.
   * 
   * @param string $rootDir
   * @see \Library\Core\ViewLoader::GetFrameworkRootDir()
   * @see \Library\Core\ViewLoader::GetApplicationRootDir()
   * @return string The directory where to find the view.
   */
  public function GetPathForView($rootDir) {
    $path = FrameworkConstants_RootDir .
            $rootDir .
            ucfirst($this->controller->module()) .
            "/" .
            ucfirst($this->controller->action()) .
            self::VIEWFILEEXTENSION;
    return $path;
  }

  /**
   * Get the directory where are stored the Framework views.
   * 
   * @return string The directory
   */
  protected static function GetFrameworkRootDir() {
    return \Library\Enums\FrameworkFolderName::ViewsFolderName;
  }

  /**
   * Get the directory where are stored the current Application views.
   * 
   * @return string The directory
   */
  protected static function GetApplicationRootDir() {
    return \Library\Enums\ApplicationFolderName::AppsFolderName .
            FrameworkConstants_AppName .
            \Library\Enums\ApplicationFolderName::ViewsFolderName;
  }

}
