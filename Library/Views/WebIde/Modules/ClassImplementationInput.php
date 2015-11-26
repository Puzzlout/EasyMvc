<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
?>
<div class="form-group">
  <label for="fileName">Select an interface that the class must implement</label>
  <input id="fileName" class="form-control" type="text" placeholder="Starting typing to autocomplete..." />
</div>
