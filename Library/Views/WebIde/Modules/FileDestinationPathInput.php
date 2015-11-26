<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/webide.solution.folderpaths.js");
?>
<div class="form-group">
  <label for="fileDirPath">Type file destination</label>
  <input id="fileDirPath" class="form-control" type="text" placeholder="Starting typing to autocomplete..." />
</div>
