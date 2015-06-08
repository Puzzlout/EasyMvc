<?php

namespace Library\Core;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');
session_start();

class User extends ApplicationComponent {

  private $appPrefix = "";

  /**
   * <p> Constructor: set the appPrefix to set in front of all session values </p>
   * @param \Library\Core\Application $app
   */
  public function __construct(Application $app) {
    parent::__construct($app);
    $this->appPrefix = strtolower(__APPNAME__);
  }

  /**
   * <p> Set a value in current session. </p>
   * @param string $sessionKey <p>
   * The session key value under which the value is stored. The set of values is
   *  found in the class(es) \Library\Enums\SessionKeys (Framework) or
   *  \Application\YourApp\Resources\Enums\SessionKeys (Application) </p>
   * @param mixed $value <p>
   * The value can any type: int, string, array, object instance of any class. </p>
   */
  public function setAttribute($sessionKey, $value) {
    $_SESSION[$this->GetKey($sessionKey)] = $value;
  }

  /**
   * <p> Get a key from a given value. </p>
   * @param string $key <p>
   * The set of values is found in the class(es) \Library\Enums\SessionKeys (Framework) or
   *  \Application\YourApp\Resources\Enums\SessionKeys (Application) </p>
   * @return string <p>
   * The computed value of $appPrefix and $key. </p>
   */
  public function GetKey($key) {
    return $this->appPrefix . "::" . $key;
  }

  /**
   * <p> Get a value in current session from a given key. </p>
   * @param sring $sessionKey <p>
   * The key to use to find the associated value. The set of values is found in 
   * the class(es) \Library\Enums\SessionKeys (Framework) or
   * \Application\YourApp\Resources\Enums\SessionKeys (Application) </p>
   * @return mixed <p>
   * The value can any type: int, string, array, object instance of any class.
   * If value is not set, then return FALSE. </p>
   */
  public function getAttribute($sessionKey) {
    return
            isset($_SESSION[$this->GetKey($sessionKey)]) ?
            $_SESSION[$this->GetKey($sessionKey)] :
            FALSE;
  }

  /**
   * <p> Remove a session-stored variable based on a given key. </p>
   * @param string $key <p>
   * A string value using the set of values is found in the class(es) 
   * \Library\Enums\SessionKeys (Framework) or
   *  \Application\YourApp\Resources\Enums\SessionKeys (Application). </p>
   */
  public function unsetAttribute($key) {
    unset($_SESSION[$this->GetKey($key)]);
  }

  /**
   * <p> Checks if the current user is connected. </p>
   * @return bool <p>
   * Values: TRUE or FALSE </p>
   */
  public function isConnected() {
    return $this->getAttribute(\Library\Enums\SessionKeys::UserConnected);
  }

  /**
   * <p> Gets the user role. </p>
   * @return string <p>
   * Role value of the current user. </p>
   */
  public function getRole() {
    return $this->getAttribute(\Library\Enums\SessionKeys::UserRole);
  }

}