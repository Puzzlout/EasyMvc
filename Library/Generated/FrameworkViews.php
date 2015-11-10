<?php
/**
 * Lists the constants for framework view files to autocompletion and easy coding.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package FrameworkViews
 */

namespace Library\Generated;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class FrameworkViews {
  const ConfigFolderKey = 'ConfigFolderKey';  const configRoutingKey = 'configRoutingKey';  const ErrorFolderKey = 'ErrorFolderKey';  const Http404Key = 'Http404Key';  public static function GetList() {    return array(      self::ConfigFolderKey => array(        self::configRoutingKey => 'configRouting',      ),      self::ErrorFolderKey => array(        self::Http404Key => 'Http404',      ),    );  }}