<?php

/**
 * Class to manage the Web IDE.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package WebIdeAjaxController
 */

namespace Library\Controllers;

use Library\Core\DirectoryManager\ArrayFilterDirectorySearch;
use Library\Core\Cache\ApcCacher;
use Library\Enums\CacheKeys;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class WebIdeAjaxController extends \Library\Controllers\BaseController {

  public function GetSolutionFolders() {
    $filter = "";
    if (array_key_exists("filter", $this->dataPost())) {
      $filterRegex = '`.*' . $this->dataPost["filter"] . '.*$`';
    } else {
      $filterRegex = '`^.*$`';
    }
    $config = $this->app->config;
    //ApcCacher::Init($config)->Remove(CacheKeys::FrameworkSolutionFolder);
    if (!ApcCacher::Init($config)->KeyExists(CacheKeys::FrameworkSolutionFolder)) {
      $SolutionPathListArray = ArrayFilterDirectorySearch::Init()->RecursiveScanOf(
              FrameworkConstants_RootDir, \Library\Core\DirectoryManager\Algorithms\ArrayListAlgorithm::ExcludeList());
      ApcCacher::Init($config)->Create(CacheKeys::FrameworkSolutionFolder, $SolutionPathListArray);

    } else {
      $SolutionPathListArray = ApcCacher::Init($this->app->config)->Read(CacheKeys::FrameworkSolutionFolder, array());
    }
    $AutocompletedFormattedList = \Library\Helpers\WebIdeAjaxHelper::Init()->ExtractListItemsFrom($SolutionPathListArray, $filterRegex);
    $Vm = \Library\ViewModels\WebIdeJsonVm::Init($this->app)->Fill($AutocompletedFormattedList);
    $this->vm = $Vm;
  }

  public function ProcessFileCreationRequest() {
    $Vm = new \Library\ViewModels\WebIdeJsonVm($this->app);
    $this->vm = $Vm;
  }

}
