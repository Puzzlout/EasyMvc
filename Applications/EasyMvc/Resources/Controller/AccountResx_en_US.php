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
  public function GetList() {    return array(      self::create => array(        self::email_label => array(        self::f_controller_resource_value => "E-mail:",        self::f_controller_resource_comment => "The label for the email input",      ),        self::h1_title => array(        self::f_controller_resource_value => "Create account View",        self::f_controller_resource_comment => "The title of the H1 element",      ),      ),      self::login => array(        self::email_label => array(        self::f_controller_resource_value => "E-mail:",        self::f_controller_resource_comment => "The label for the email input",      ),        self::email_ph_text => array(        self::f_controller_resource_value => "e-mail address",        self::f_controller_resource_comment => "The input placeholder for the e-mail",      ),        self::h1_title => array(        self::f_controller_resource_value => "Login View",        self::f_controller_resource_comment => "The title of the H1 element",      ),        self::login_btn_text => array(        self::f_controller_resource_value => "Login",        self::f_controller_resource_comment => "The label for the Login button",      ),        self::PageTitle => array(        self::f_controller_resource_value => "EasyMvc - Login",        self::f_controller_resource_comment => "The title of the page",      ),        self::pwd_label => array(        self::f_controller_resource_value => "Password",        self::f_controller_resource_comment => "The label for the password",      ),        self::pwd_ph_text => array(        self::f_controller_resource_value => "type password",        self::f_controller_resource_comment => "The input placeholder for the password",      ),        self::username_label => array(        self::f_controller_resource_value => "Username",        self::f_controller_resource_comment => "The label for the username input",      ),        self::username_ph_text => array(        self::f_controller_resource_value => "type your username",        self::f_controller_resource_comment => "The input placeholder for the username",      ),      ),    );  }
}