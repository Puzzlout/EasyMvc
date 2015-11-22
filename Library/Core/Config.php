<?php

namespace Library\Core;

use Library\FrameworkConstants;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class Config extends ApplicationComponent {

  protected $settings = array();
  private $xmlReader;

  public function __construct(Application $app) {
    parent::__construct($app);
    $this->AssignSettingsToArray();
  }

  /**
   * Sets the appsettings to the $settings array associatively.
   * 
   * @param string $SettingsClass
   */
  private function AssignSettingsToArray() {
    try {
      $SettingsClass = "\\Applications\\" . FrameworkConstants_AppName . "\\Config\\AppSettings";
      $this->settings[$this->app->name] = $SettingsClass::Init()->GetSettings();
    } catch (\ErrorException $exc) {
      throw new \RuntimeException("Couldn't execute the method $GetMethod in $SettingsClass", 0, $exc);
    }
  }

  /**
   * Gets the value for the given key.
   * @param string $key
   * @param string $appName Optional parameter when we need to access another Application settings
   * @return boolean|string : The value associated to the key given. Otherwise FALSE
   */
  public function Get($key, $appName = NULL) {
    if (!is_null($appName) && (!$this->settings || !isset($this->settings[$appName]) || !isset($this->settings[$appName][$key]))) {
      throw new \RuntimeException("$key was not found in the Settings for " . $appName . ". See above array. " . var_dump($this->settings), 0, NULL);
    }
    if ((!$this->settings || !isset($this->settings[$this->app->name]) || !isset($this->settings[$this->app->name][$key]))) {
      throw new \RuntimeException("$key was not found in the Settings for " . $this->app->name . ". See above array. " . var_dump($this->settings), 0, NULL);
    } else {
      $appName = $this->app->name;
    }
    return $this->settings[$appName][$key];
  }

}
