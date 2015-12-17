<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
?>
<div class="form-group">
  <label for="fileType">Select the file type</label>
  <select id="fileType" class="form-control">
    <?php
    foreach (Library\GeneratorEngine\Constants\FileTypes::Init()->RetrieveList() as $key => $displayedText) {
      echo '<option data-id="' . $key . '">' . $displayedText . '</option>';
    }
    ?>
  </select>
</div>