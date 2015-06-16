<?php

/**
 *
 * @package		Easy MVC Framework
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license
 * @link
 * @since
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Authenticate controller Class
 *
 * @subpackage  Applications\EasyMvc
 * @category 	Controllers
 * @author		Jeremie Litzler
 * @link
 */

namespace Applications\EasyMvc\Controllers;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__')) {
  exit('No direct script access allowed');
}

class AuthenticateController extends \Library\Controllers\BaseController {

  /**
   * Method that loads the Login view.
   *
   * It loads the page title and the resources to load in the placeholders
   *
   * @param \Library\HttpRequest $rq: the request
   */
  public function executeLoadLoginView(\Library\Core\HttpRequest $rq) {
    $this->executeDisconnect($rq, FALSE);
  }

  /**
   * Method that receives the call from JS Client to login a user
   *
   * @param \Library\HttpRequest $rq: the request
   * @return json object A JSON object with the result bool value and success/error message
   */
  public function executeAuthenticate(\Library\Core\HttpRequest $rq) {
    //Initialize the response to error.
    $result = $this->InitResponseWS();

    //Let's retrieve the inputs from AJAX POST request
    $data_sent = $rq->retrievePostAjaxData(FALSE);

    //Then, retrieve the login and password.
    $user = $this->PrepareUserObject($data_sent);

    //Load interface to query the database
    $manager = $this->managers->getManagerOf('Login');
    //Search for user in DB and return him
    $user_db = $manager->selectOne($user);

    //If user_db is null or not matching, set error message
    if (count($user_db) === 0) {
      //TODO: redirect after 3 sec
      //$this->Redirect("login");
    } else {
      if (!isset($data_sent["encrypt_pwd"])) {
        $this->EncryptUserPassword($manager, $user, $user_db);
      }
      //User is correct so log him in and set result to success
      $result = $this->InitResponseWS("success", $user_db);
    }
    //return the JSON data
    echo \Library\HttpResponse::encodeJson($result);
  }

  /**
   * Method that logout a user from the session and then redirect him to Login page.
   *
   * @param \Library\HttpRequest $rq
   */
  public function executeDisconnect(\Library\Core\HttpRequest $rq, $redirect = TRUE) {
    $this->app()->auth->deauthenticate();
    if ($redirect) {
      $this->Redirect("login");
    }
  }

  /**
   * Method that logout a user from the session and then redirect him to Login page.
   *
   * @param \Library\HttpRequest $rq
   */
  public function executeCreate(\Library\Core\HttpRequest $rq) {
    $protect = new \Library\Security\Encryption($this->app()->config());
    $data = array(
        "username" => $rq->getData("login"),
        "password" => $rq->getData("pwd"),
        "pm_name" => "Demo User"
    );
    //TODO: implement user creation
    $user = \Library\Helpers\CommonHelper::PrepareUserObject($data, new Library\BO\User());
    $user->setPassword($protect->HashValue($this->app->config->get("PaswordSalt"), $user->password()));

    $loginDal = $this->managers->getManagerOf("Login");
    $id = $loginDal->add($user);
    $redirect = intval($id) > 0 ? TRUE : FALSE;

    if ($redirect) {
      $this->Redirect("login");
    }
  }

  /**
   * Method that logs in a user in the session.
   *
   */
  private function LoginUser($user) {
    //store user in session
    $this->app->user->setAttribute(\Library\Enums\SessionKeys::UserConnected, $user);
  }

  /**
   * HashValue the user password
   * 
   * @param type $manager
   * @param type $user_in
   * @param type $user_db
   */
  private function EncryptUserPassword($manager, $user_in, $user_db) {
    $protect = new \Library\Security\Encryption($this->app()->config());
    $user_in->setPassword($protect->HashValue($this->app->config->get("PaswordSalt"), $user_in->password()));
    $user_in->pm_id = $user_db[0]->pm_id;
    $manager->update($user_in);
  }

}
