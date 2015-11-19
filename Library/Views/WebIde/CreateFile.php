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
<h1>Create a file</h1>
<form action="WebIde/CreateFile" method="POST">
  <input type="text" placeholder="file type (class, view, vm, helper, etc...)" />
  <input type="text" placeholder="Type file description" />
  <input type="text" placeholder="Type class name" />
  <input type="text" placeholder="Type class destination" />
  <?php  include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::ClassPropertiesForm); ?>
  <?php  include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(FrameworkViewnames::ClassMethodsForm); ?>
</form>