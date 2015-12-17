<?php

namespace Library\Utility;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ImageUtility extends \Library\Core\ApplicationComponent {

  protected $settings = array();

  public function getImageUrl($image_name) {
    if (isset($image_name) || $image_name === "") {
      $imageFolderPath = $this->app->config()->get("RootImageFolderPath");

      return $imageFolderPath . $image_name;
    }
    throw \InvalidArgumentException("Missing Image name!");
  }
}
