<?php

/**
 * Class to manage the Web IDE.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package AjaxController
 */

namespace Applications\Ide\Controllers;

use Applications\Ide\Helpers\AjaxHelper;
use Applications\Ide\Helpers\CreateFileHelper;
use Applications\Ide\ViewModels\MainJsonVm;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class AjaxController extends \Library\Controllers\BaseController {

  /**
   * Retrieve the list of ListItem objects containing the folders found in the 
   * solution. The full list is filtered by the $filterRegex sent via the POST
   * request.
   */
  public function GetSolutionFolders() {
    $filterRegex = AjaxHelper::Init()->GetFilterRegex($this->dataPost());
    $SolutionPathListArray = AjaxHelper::Init()->GetSolutionDirectoryList($this->app);
    $AutocompletedFormattedList = AjaxHelper::Init()->ExtractListItemsFrom($SolutionPathListArray, $filterRegex);
    $Viewmodel = MainJsonVm::Init($this->app)->Fill($AutocompletedFormattedList);
    $this->viewModel = $Viewmodel;
  }
  
  /**
   * Retrieve the list of ListItem objects containing the files found in the 
   * solution. The full list is filtered by the $filterRegex sent via the POST
   * request.
   */
  public function GetSolutionFilesOnly() {
    $filterRegex = AjaxHelper::Init()->GetFilterRegex($this->dataPost());
    $Files = AjaxHelper::Init()->GetSolutionFilesOnly($this->app);
    $AutocompletedFormattedList = AjaxHelper::Init()->ExtractListItemsFrom($Files, $filterRegex);
    $Viewmodel = MainJsonVm::Init($this->app)->Fill($AutocompletedFormattedList);
    $this->viewModel = $Viewmodel;
  }

  /**
   * Retrieves a template contents from a fileType value sent in the POST request.
   */
  public function GetTemplateContents() {
    $templateContents = 
            CreateFileHelper::Init()
            ->GetFileType($this->dataPost())
            ->GetTemplateContents();
    $Viewmodel = MainJsonVm::Init($this->app)->Fill($templateContents);
    $this->viewModel = $Viewmodel;
  }
  /**
   * Create a file from the POST data.
   */
  public function ProcessFileCreation() {
    $result = CreateFileHelper::Init()->SaveFile($this);
    $Viewmodel = new MainJsonVm($this->app);
    $Viewmodel->Fill($result);
    $this->viewModel = $Viewmodel;
  }
}
