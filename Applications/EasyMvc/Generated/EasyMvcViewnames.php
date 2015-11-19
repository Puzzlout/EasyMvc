<?php
/**
 * Lists the constants for application viewnames to use for autocompletion and easy coding.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package EasyMvcViewnames
 */

namespace Applications\EasyMvc\Generated;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class EasyMvcViewnames {
  const AccountFolder = 'AccountFolder';  const Login = 'Login';  const ModulesFolder = 'ModulesFolder';  const LoginForm = 'LoginForm';  const MapFolder = 'MapFolder';  const loadView = 'loadView';  const active_list = 'active_list';  const active_task_tabs_open = 'active_task_tabs_open';  const categorized_list_left = 'categorized_list_left';  const categorized_list_right = 'categorized_list_right';  const company_form = 'company_form';  const complete_task_tabs_open = 'complete_task_tabs_open';  const group_list_left = 'group_list_left';  const group_list_right = 'group_list_right';  const inactive_list = 'inactive_list';  const map = 'map';  const popup_msg = 'popup_msg';  const tabs_close = 'tabs_close';  const task_tabs_open = 'task_tabs_open';  const upload_file = 'upload_file';  const SharedFolder = 'SharedFolder';  public static function GetList() {    return array(      self::AccountFolder => array(        self::Login => 'Login',        self::ModulesFolder => array(        self::LoginForm => 'LoginForm',      ),      ),      self::MapFolder => array(        self::loadView => 'loadView',      ),      self::ModulesFolder => array(        self::active_list => 'active_list',        self::active_task_tabs_open => 'active_task_tabs_open',        self::categorized_list_left => 'categorized_list_left',        self::categorized_list_right => 'categorized_list_right',        self::company_form => 'company_form',        self::complete_task_tabs_open => 'complete_task_tabs_open',        self::group_list_left => 'group_list_left',        self::group_list_right => 'group_list_right',        self::inactive_list => 'inactive_list',        self::map => 'map',        self::popup_msg => 'popup_msg',        self::tabs_close => 'tabs_close',        self::task_tabs_open => 'task_tabs_open',        self::upload_file => 'upload_file',      ),      self::SharedFolder => array(      ),    );  }}