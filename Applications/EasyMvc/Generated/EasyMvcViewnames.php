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
  const ACCOUNTFOLDER = 'AccountFolder';  const LOGIN = 'Login';  const MODULESFOLDER = 'ModulesFolder';  const LOGINFORM = 'LoginForm';  const MAPFOLDER = 'MapFolder';  const LOADVIEW = 'loadView';  const ACTIVE_LIST = 'active_list';  const ACTIVE_TASK_TABS_OPEN = 'active_task_tabs_open';  const CATEGORIZED_LIST_LEFT = 'categorized_list_left';  const CATEGORIZED_LIST_RIGHT = 'categorized_list_right';  const COMPANY_FORM = 'company_form';  const COMPLETE_TASK_TABS_OPEN = 'complete_task_tabs_open';  const GROUP_LIST_LEFT = 'group_list_left';  const GROUP_LIST_RIGHT = 'group_list_right';  const INACTIVE_LIST = 'inactive_list';  const MAP = 'map';  const POPUP_MSG = 'popup_msg';  const TABS_CLOSE = 'tabs_close';  const TASK_TABS_OPEN = 'task_tabs_open';  const UPLOAD_FILE = 'upload_file';  public static function GetList() {    return array(      self::AccountFolder => array(        self::LOGIN => 'Login',        self::ModulesFolder => array(        self::LOGINFORM => 'LoginForm',      ),      ),      self::MapFolder => array(        self::LOADVIEW => 'loadView',      ),      self::ModulesFolder => array(        self::ACTIVE_LIST => 'active_list',        self::ACTIVE_TASK_TABS_OPEN => 'active_task_tabs_open',        self::CATEGORIZED_LIST_LEFT => 'categorized_list_left',        self::CATEGORIZED_LIST_RIGHT => 'categorized_list_right',        self::COMPANY_FORM => 'company_form',        self::COMPLETE_TASK_TABS_OPEN => 'complete_task_tabs_open',        self::GROUP_LIST_LEFT => 'group_list_left',        self::GROUP_LIST_RIGHT => 'group_list_right',        self::INACTIVE_LIST => 'inactive_list',        self::MAP => 'map',        self::POPUP_MSG => 'popup_msg',        self::TABS_CLOSE => 'tabs_close',        self::TASK_TABS_OPEN => 'task_tabs_open',        self::UPLOAD_FILE => 'upload_file',      ),    );  }}