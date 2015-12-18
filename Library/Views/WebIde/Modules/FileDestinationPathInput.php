<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/webide.solution.autocomplete.js");
?>
<div class="form-group">
  <label for="fileDirPath">Type file destination</label>
  <input class="form-control autocomplete-item" data-ctrl="WebIdeAjax" data-action="GetSolutionFolders" type="text" placeholder="Starting typing to autocomplete..." />
</div>
