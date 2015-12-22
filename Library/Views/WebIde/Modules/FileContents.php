<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/webide.solution.templates.js");
?>
<div class="form-group">
  <label for="fileContents">Modify the file template to suit your needs</label>
  <textarea id="fileContents" name="fileContents" class="form-control" rows="20"></textarea>
</div>
