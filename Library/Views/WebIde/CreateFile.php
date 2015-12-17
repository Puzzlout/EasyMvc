<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

use Library\Generated\FrameworkViewnames;

$ViewModel = new Library\ViewModels\WebIdeVm($this->app);
if (!($Vm instanceof Library\ViewModels\WebIdeVm)) {
  throw new Library\Exceptions\InvalidViewModelTypeException();
} else {
  $ViewModel = clone $Vm;
}
?>
<?php echo Library\UC\StylesheetControl::Init()->ForInternalResource("Web/library/css/webide.css"); ?>
<h1>Create a file</h1>
<?php echo Library\UC\LinkControl::Init()->Simple("../Generator/Index", "Go to Code generator"); ?>
<form id="fileCreationForm" action="WebIde/ProcessFileCreationRequest" method="POST">
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::FILETYPEINPUT); ?>
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::FILEDESCRIPTIONINPUT); ?>
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::FILEDESTINATIONPATHINPUT); ?>
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::FILECONTENTS); ?>
  <button type="submit" class="btn btn-info">Create File</button>
</form>