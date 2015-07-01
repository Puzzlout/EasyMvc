<?php

namespace Library\Security;

use Library\Interfaces\IUser;
use Library\Enums\SessionKeys;

/**
 * Provides the methods to manage user authentication. 
 */
class AuthenticationManager {

  private $app;

  public function __construct($app) {
    $this->app = $app;
  }

  /**
   * Authenticates a user from the given object. 
   * @param \Library\Interfaces\IUser $user
   * User object holding all the values necessary to connect the user.  
   */
  public function authenticate(IUser $user) {
    //set role
    $this->app->user->setAttribute(SessionKeys::UserRole, $user->getRole());
    //store user in session
    $this->app->user->setAttribute(SessionKeys::UserConnected, $user);
  }

  /**
   * Deauthenticate a user from current session. 
   * Then the session is detroyed. 
   */
  public function deauthenticate() {
    $this->app->user->unsetAttribute(SessionKeys::UserConnected);
    session_destroy();
  }

  /**
   * Retrieve the hash of the user password. 
   * @param \Library\BO\F_user $user
   * @return \Library\BO\F_user
   */
  public function HashUserPassword(\Library\BO\F_user $user) {
    $user->setF_user_salt(\Library\Utility\UUID::v4());
    $user->setF_user_password($this->app->security()->HashValue($user->F_user_salt(), $user->F_user_password()));
    $user->setF_user_password_is_hashed(1);
    return $user;
  }

}
