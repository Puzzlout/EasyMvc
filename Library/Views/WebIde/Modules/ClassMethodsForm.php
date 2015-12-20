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
<fieldset>
  <legend>List of methods</legend>
  <input type="text" placeholder="Type your method name" />
  <input type="text" placeholder="Type your return type" />
  <?php include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::METHODPARAMETERS); ?>
  <div class="add-a-property"></div>
</fieldset>

