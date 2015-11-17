<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
$ViewModel = new Library\ViewModels\WebIdeVm($this->app);
if (!($Vm instanceof Library\ViewModels\WebIdeVm)) {
  throw new Library\Exceptions\InvalidViewModelTypeException();
} else {
  $ViewModel = clone $Vm;
}
?>
<fieldset>
  <legend>List of methods</legend>
  <input type="text" placeholder="Type your method name" />
  <input type="text" placeholder="Type your return type" />
  <?php include_once Library\Core\ViewLoader::GetPartialView("WebIde", "MethodParameters"); ?>
  <div class="add-a-property"></div>
</fieldset>

