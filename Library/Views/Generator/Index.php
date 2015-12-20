<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
$ViewModel = new Library\ViewModels\GeneratorVm($this->app);
if (!($ControllerVm instanceof Library\ViewModels\GeneratorVm)) {
  throw new Library\Exceptions\InvalidViewModelTypeException();
} else {
  $ViewModel = clone $ControllerVm;
}
        const ControllerGeneratorUrl = "../Generator/BuildControllerConstantsClass";
        const ControllerGeneratorText = "Generate controller constants class";
        const DalModuleGeneratorUrl = "../Generator/BuildDalModuleConstantsClass";
        const DalModuleGeneratorText = "Generate dal module constants class";
        const ViewNameGeneratorUrl = "../Generator/BuildViewNameConstantsClass";
        const ViewNameGeneratorText = "Generate viewname constants class";
        const DaoGeneratorUrl = "../Generator/BuildDao";
        const DaoGeneratorText = "Refresh the DAO classes";
        const ResourceGeneratorUrl = "../Generator/BuildResources";
        const ResourceGeneratorText = "Refresh the resources from the database";
?>
<h1>Generator scripts</h1>
<p>On this page, you can generate code by simple click.</p>
<ul>
  <li><?php echo \Library\UC\LinkControl::Init()->Simple(ControllerGeneratorUrl, ControllerGeneratorText); ?></li>
  <li><?php echo \Library\UC\LinkControl::Init()->Simple(DalModuleGeneratorUrl, DalModuleGeneratorText); ?></li>
  <li><?php echo \Library\UC\LinkControl::Init()->Simple(ViewNameGeneratorUrl, ViewNameGeneratorText); ?></li>
  <li><?php echo \Library\UC\LinkControl::Init()->Simple(DalModuleGeneratorUrl, DaoGeneratorText); ?></li>
  <li><?php echo \Library\UC\LinkControl::Init()->Simple(ResourceGeneratorUrl, ResourceGeneratorText); ?></li>
</ul>
</body>
</html>