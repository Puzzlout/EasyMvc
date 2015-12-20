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
?>
    <div class="top-bar">
      <a href="Index">Back</a>
    </div>
    <div class="content">
      <p>Files generated:</p>
      <ul>
        <?php
        foreach ($ViewModel->filesGenerated as $file) {
          echo '<li><a href="' .$file .'">' . $file . '</a></li>';
        }
        ?>
      </ul>
    </div>
  </body>
</html>
