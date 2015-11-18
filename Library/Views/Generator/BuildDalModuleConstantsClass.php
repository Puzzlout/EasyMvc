<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
include_once Library\Core\ViewLoader::GetPartialView("Generator", "DisplayGeneratedFiles");
