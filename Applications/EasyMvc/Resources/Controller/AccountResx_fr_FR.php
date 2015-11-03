<?php
/**
 * List of the resources values for the module account
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package AccountResx_fr_FR extends AccountResx
 */

namespace Applications\EasyMvc\Resources\Controller;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class AccountResx_fr_FR extends AccountResx {
  public function GetList() {    return array(      self::create => array(        self::email_label => array(        self::f_controller_resource_value => "E-mail :",        self::f_controller_resource_comment => "Le libellé de l'input email",      ),        self::h1_title => array(        self::f_controller_resource_value => "Vue Création de compte",        self::f_controller_resource_comment => "Le titre de l'élément H1",      ),      ),      self::login => array(        self::email_label => array(        self::f_controller_resource_value => "E-mail :",        self::f_controller_resource_comment => "Le libellé de l'input email",      ),        self::h1_title => array(        self::f_controller_resource_value => "Vue Connexion",        self::f_controller_resource_comment => "Le titre de l'élément H1",      ),        self::PageTitle => array(        self::f_controller_resource_value => "EasyMvc - Login",        self::f_controller_resource_comment => "The title of the page",      ),      ),    );  }
}