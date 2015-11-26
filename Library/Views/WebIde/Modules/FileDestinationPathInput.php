<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
?>
<script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/webide.solution.folderpaths.js"></script>
<div class="form-group">
  <label for="fileDirPath">Type file destination</label>
  <input id="fileDirPath" class="form-control" type="text" placeholder="Starting typing to autocomplete..." />
</div>
