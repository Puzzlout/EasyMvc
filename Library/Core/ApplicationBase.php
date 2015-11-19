<?php

/**
 * The base structure of the Application instance
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ApplicationBase
 */

namespace Library\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class ApplicationBase {

  const CONTROLLER_NAME_PREFIX = "F_";
  const CULTURES_ARRAY_KEY = "application_cultures";

  public $HttpRequest;
  protected $httpResponse;
  public $name;
  public $locale;
  public $localeDefault;
  public $pageTitle;
  public $logoImageUrl;
  public $globalResources;
  public $relative_path;
  public $user;
  public $config;
  public $i8n;
  public $imageUtil;
  public $jsManager;
  public $cssManager;
  public $auth;
  public $dal;
  public $toolTip;
  protected $security;
  public $error;
  public $cultures = array();
  public $ResourceManager;
  public $controller;

  public function HttpRequest() {
    return $this->httpRequest;
  }

  public function httpResponse() {
    return $this->httpResponse;
  }

  public function user() {
    return $this->user;
  }

  public function config() {
    return $this->config;
  }

  public function context() {
    return $this->context;
  }

  public function i8n() {
    return $this->i8n;
  }

  public function router() {
    return $this->router;
  }

  public function name() {
    return $this->name;
  }

  public function css() {
    return $this->cssManager;
  }

  public function js() {
    return $this->jsManager;
  }

  public function auth() {
    return $this->auth;
  }

  public function dal() {
    return $this->dal;
  }

  public function toolTip() {
    return $this->toolTip;
  }

  public function security() {
    return $this->security;
  }

  public function Resx() {
    return $this->ResourceManager;
  }
  
  public function controller() {
    return $this->controller;
  }
}
