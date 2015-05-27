<?php

namespace Library\Core;

if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');
session_start();

class User extends ApplicationComponent {

  public function getAttribute($attr) {
    return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
  }

  public function getFlash() {
    $flash = $_SESSION[\Library\Enums\SessionKeys::UserFlash];
    unset($_SESSION[\Library\Enums\SessionKeys::UserFlash]);

    return $flash;
  }

  public function hasFlash() {
    return isset($_SESSION[\Library\Enums\SessionKeys::UserFlash]);
  }

  public function isAuthenticated() {
    return isset($_SESSION[\Library\Enums\SessionKeys::UserAuthenticated]) && $_SESSION[\Library\Enums\SessionKeys::UserAuthenticated] === true;
  }

  public function setAttribute($attr, $value) {
    $_SESSION[$attr] = $value;
  }

  public function setAuthenticated($authenticated = true) {
    if (!is_bool($authenticated)) {
      throw new \InvalidArgumentException('Value of method User::setAuthenticated() must be a boolean');
    }

    $_SESSION[\Library\Enums\SessionKeys::UserAuthenticated] = $authenticated;
  }

  public function setFlash($value) {
    $_SESSION[\Library\Enums\SessionKeys::UserFlash] = $value;
  }
  /**
   * Unset a session item of given key
   * 
   * @param string $key (\Library\Enums\SessionKeys)
   */
  public function unsetAttribute($key) {
    unset($_SESSION[$key]);
  }

  public function keyExistInSession($key) {
    return isset($_SESSION[$key]);
  }
}