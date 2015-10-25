<?php
/**
 * List of the resources for the moduleaccount
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package AccountResx_en_GB extends \Library\Core\ResourceManagers\ComntrollerResxBase
 */

namespace Applications\EasyMvc\Ressources\Controller;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class AccountResx_en_GB extends \Library\Core\ResourceManagers\ComntrollerResxBase {
  const createKey = 'createKey';  const email_labelKey = 'email_labelKey';  const h1_titleKey = 'h1_titleKey';  const loginKey = 'loginKey';  const email_labelKey = 'email_labelKey';  const h1_titleKey = 'h1_titleKey';  public static function GetList() {    return array(      self::createKey => array(        self::email_labelKey => array(        self::f_controller_resource_valueKey => "E-mail:",        self::f_controller_resource_commentKey => "The label for the email input",      ),        self::h1_titleKey => array(        self::f_controller_resource_valueKey => "Create account View",        self::f_controller_resource_commentKey => "The title of the H1 element",      ),      ),      self::loginKey => array(        self::email_labelKey => array(        self::f_controller_resource_valueKey => "E-mail:",        self::f_controller_resource_commentKey => "The label for the email input",      ),        self::h1_titleKey => array(        self::f_controller_resource_valueKey => "Login View",        self::f_controller_resource_commentKey => "The title of the H1 element",      ),      ),    );  }
}