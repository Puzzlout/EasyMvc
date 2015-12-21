<?php
/**
 * List of the resources values for the module account
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package AccountResx_en_US extends AccountResx
 */

namespace Applications\EasyMvc\Resources\Controller;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class AccountResx_en_US extends AccountResx {
  public function GetList() {    return array(      self::CREATE => array(        self::EMAIL_LABEL => array(        self::F_CONTROLLER_RESOURCE_VALUE => "E-mail:",        self::F_CONTROLLER_RESOURCE_COMMENT => "The label for the email input",      ),        self::H1_TITLE => array(        self::F_CONTROLLER_RESOURCE_VALUE => "Create account View",        self::F_CONTROLLER_RESOURCE_COMMENT => "The title of the H1 element",      ),      ),      self::LOGIN => array(        self::EMAIL_LABEL => array(        self::F_CONTROLLER_RESOURCE_VALUE => "E-mail:",        self::F_CONTROLLER_RESOURCE_COMMENT => "The label for the email input",      ),        self::EMAIL_PH_TEXT => array(        self::F_CONTROLLER_RESOURCE_VALUE => "e-mail address",        self::F_CONTROLLER_RESOURCE_COMMENT => "The input placeholder for the e-mail",      ),        self::H1_TITLE => array(        self::F_CONTROLLER_RESOURCE_VALUE => "Login View",        self::F_CONTROLLER_RESOURCE_COMMENT => "The title of the H1 element",      ),        self::LOGIN_BTN_TEXT => array(        self::F_CONTROLLER_RESOURCE_VALUE => "Login",        self::F_CONTROLLER_RESOURCE_COMMENT => "The label for the Login button",      ),        self::PAGETITLE => array(        self::F_CONTROLLER_RESOURCE_VALUE => "EasyMvc - Login",        self::F_CONTROLLER_RESOURCE_COMMENT => "The title of the page",      ),        self::PWD_LABEL => array(        self::F_CONTROLLER_RESOURCE_VALUE => "Password",        self::F_CONTROLLER_RESOURCE_COMMENT => "The label for the password",      ),        self::PWD_PH_TEXT => array(        self::F_CONTROLLER_RESOURCE_VALUE => "type password",        self::F_CONTROLLER_RESOURCE_COMMENT => "The input placeholder for the password",      ),        self::USERNAME_LABEL => array(        self::F_CONTROLLER_RESOURCE_VALUE => "Username",        self::F_CONTROLLER_RESOURCE_COMMENT => "The label for the username input",      ),        self::USERNAME_PH_TEXT => array(        self::F_CONTROLLER_RESOURCE_VALUE => "type your username",        self::F_CONTROLLER_RESOURCE_COMMENT => "The input placeholder for the username",      ),      ),    );  }
}