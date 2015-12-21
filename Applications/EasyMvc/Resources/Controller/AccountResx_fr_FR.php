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
  public function GetList() {    return array(      self::CREATE => array(        self::EMAIL_LABEL => array(        self::F_CONTROLLER_RESOURCE_VALUE => "E-mail :",        self::F_CONTROLLER_RESOURCE_COMMENT => "Le libellé de l'input email",      ),        self::H1_TITLE => array(        self::F_CONTROLLER_RESOURCE_VALUE => "Vue Création de compte",        self::F_CONTROLLER_RESOURCE_COMMENT => "Le titre de l'élément H1",      ),      ),      self::LOGIN => array(        self::EMAIL_LABEL => array(        self::F_CONTROLLER_RESOURCE_VALUE => "E-mail :",        self::F_CONTROLLER_RESOURCE_COMMENT => "Le libellé de l'input email",      ),        self::H1_TITLE => array(        self::F_CONTROLLER_RESOURCE_VALUE => "Vue Connexion",        self::F_CONTROLLER_RESOURCE_COMMENT => "Le titre de l'élément H1",      ),        self::PAGETITLE => array(        self::F_CONTROLLER_RESOURCE_VALUE => "EasyMvc - Login",        self::F_CONTROLLER_RESOURCE_COMMENT => "The title of the page",      ),      ),    );  }
}