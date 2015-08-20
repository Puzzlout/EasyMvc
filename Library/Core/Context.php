<?php

namespace Library\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class Context extends ApplicationComponent {

  public $defaultLang = null;

  public function __construct(Application $app) {
    parent::__construct($app);
  }

  public function setLanguage() {
    $this->defaultLang = $this->app->config()->get(\Library\Enums\AppSettingKeys::DefaultCulture);
  }

}
