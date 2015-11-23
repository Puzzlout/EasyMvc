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
   *
   * @var Application The current app 
   */
  public $app;
  
  /**
   * 
   * @var \Library\Controllers\BaseController $controller The controller object 
   */
  public $controller;
  
  /**
   * Instantiate the class.
   * 
   * @param \Library\Controllers\BaseController $controller The controller to find the view.
   * @return \Library\Core\ViewLoader The instance of the class.
   */
  public static function Init(\Library\Controllers\BaseController $controller) {
    $viewLoader = new ViewLoader();
    $viewLoader->controller = $controller;
    return $viewLoader;
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
    $FrameworkView = $this->GetPathForView(DirectoryManager::GetFrameworkRootDir());
    $ApplicationView = $this->GetPathForView(DirectoryManager::GetApplicationRootDir());

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
   * @param string $viewName The name of view to load
   * @throws \Library\Exceptions\ViewNotFoundException Throws an exception if the view is not found 
   * @see \Library\Core\ViewLoader::GetFrameworkRootDir()
   * @see \Library\Core\ViewLoader::GetApplicationRootDir()
   */
  public function GetPartialView($viewName) {
    $ListOfPathToCheck = array(
        DirectoryManager::GetFrameworkRootDir() . "Modules/",
        DirectoryManager::GetFrameworkRootDir() . $this->controller->module() . "/Modules/",
        DirectoryManager::GetApplicationRootDir() . "/Modules/",
        DirectoryManager::GetApplicationRootDir() . $this->controller->module() . "/Modules/"
    );
    foreach ($ListOfPathToCheck as $path) {
      $fileToCheck = $path . $viewName . self::VIEWFILEEXTENSION;
      if (file_exists($fileToCheck)) {
        return $fileToCheck;
      }
    }
    throw new \Library\Exceptions\ViewNotFoundException("Partial view \"" . $viewName . "\" not found in " . var_dump($ListOfPathToCheck));
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
}
