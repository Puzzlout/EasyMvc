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
<link rel="stylesheet" type="text/css" href="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/css/ide.css" /><h1>Create a file</h1>
<form id="fileCreationForm" action="WebIde/ProcessFileCreationRequest" method="POST">
  <div class="form-group">
    <label for="fileType">Select the file type</label>
    <select class="form-control">
      <?php
      foreach (Library\GeneratorEngine\Constants\FileTypes::RetrieveList() as $key => $displayedText) {
        echo '<option data-id="'.$key.'">'.$displayedText.'</option>';
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="fileDesc">Type file description</label>
    <textarea id="fileDesc" class="form-control" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="fileName">Type the class name</label>
    <input id="fileName" class="form-control" type="text" />
  </div>
  <div class="form-group">
    <label for="fileDirPath">Type class destination</label>
    <input id="fileDirPath" class="form-control" type="text" />
  </div>
<?php //include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::ClassPropertiesForm); ?>
<?php //include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::ClassMethodsForm); ?>
  <button type="submit" class="btn btn-info">Create File</button>
</form>