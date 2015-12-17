<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
include_once Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(\Library\Generated\FrameworkViewnames::DISPLAYGENERATEDFILES);

