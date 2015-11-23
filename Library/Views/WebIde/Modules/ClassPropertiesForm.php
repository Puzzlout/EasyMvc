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
  <legend>List of properties</legend>
  <input type="text" placeholder="Type your property" value="" />
  <div class="add-a-property"></div>
</fieldset>

