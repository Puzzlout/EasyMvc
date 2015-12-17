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

use Library\Helpers\WebIdeAjaxHelper;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class WebIdeAjaxController extends \Library\Controllers\BaseController {

  /**
   * Retrieve the list of ListItem objects containing the folders found in the 
   * solution. The full list is filtered by the $filterRegex sent via the POST
   * request.
   */
  public function GetSolutionFolders() {
    $filterRegex = WebIdeAjaxHelper::Init()->GetFilterRegex($this->dataPost());
    $SolutionPathListArray = WebIdeAjaxHelper::Init()->GetSolutionDirectoryList($this->app);
    $AutocompletedFormattedList = WebIdeAjaxHelper::Init()->ExtractListItemsFrom($SolutionPathListArray, $filterRegex);
    $Vm = \Library\ViewModels\WebIdeJsonVm::Init($this->app)->Fill($AutocompletedFormattedList);
    $this->viewModel = $Vm;
  }
  
  /**
   * Retrieve the list of ListItem objects containing the files found in the 
   * solution. The full list is filtered by the $filterRegex sent via the POST
   * request.
   */
  public function GetSolutionFilesOnly() {
    $filterRegex = WebIdeAjaxHelper::Init()->GetFilterRegex($this->dataPost());
    $Files = WebIdeAjaxHelper::Init()->GetSolutionFilesOnly($this->app);
    $AutocompletedFormattedList = WebIdeAjaxHelper::Init()->ExtractListItemsFrom($Files, $filterRegex);
    $Vm = \Library\ViewModels\WebIdeJsonVm::Init($this->app)->Fill($AutocompletedFormattedList);
    $this->viewModel = $Vm;
  }

  /**
   * Retrieves a template contents from a fileType value sent in the POST request.
   */
  public function GetTemplateContents() {
    $fileType = WebIdeAjaxHelper::Init()->GetFileType($this->dataPost());
    $Vm = \Library\ViewModels\WebIdeJsonVm::Init($this->app)->Fill($fileType);
    $this->viewModel = $Vm;
  }
  
  public function ProcessFileCreationRequest() {
    $Vm = new \Library\ViewModels\WebIdeJsonVm($this->app);
    $this->viewModel = $Vm;
  }

}
