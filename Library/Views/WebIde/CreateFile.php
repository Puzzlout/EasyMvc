<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

use Library\Generated\FrameworkViewnames;

$ViewModel = new Library\ViewModels\WebIdeVm($this->app);
if (!($ControllerVm instanceof Library\ViewModels\WebIdeVm)) {
  throw new Library\Exceptions\InvalidViewModelTypeException();
} else {
  $ViewModel = clone $ControllerVm;
}
?>
<?php echo Library\UC\StylesheetControl::Init()->ForInternalResource("Web/library/css/webide.css"); ?>
<?php echo Library\UC\LinkControl::Init()->Simple("../Generator/Index", "Go to Code generator"); ?>
<h1>Create a file</h1>
<form class="fileCreationForm">
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::FILETYPEINPUT); ?>
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::FILENAMEINPUT); ?>
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::FILEDESCRIPTIONINPUT); ?>
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::FILEDESTINATIONPATHINPUT); ?>
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::FILECONTENTS); ?>
  <button id="createFile" class="btn btn-info" action="WebIdeAjax/ProcessFileCreation">Create File</button>
</form>
<?php echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/webide.createfile.js"); ?>