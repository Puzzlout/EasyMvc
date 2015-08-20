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
 * ResxFileNameKeys Class.
 * These are used for the framework level resources (found Application/Your_App/Resources/Common)
 *
 * @package		Library
 * @category	Enums/ResourceKeys
 * @category	ResxFileNameKeys
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Enums\ResourceKeys;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class ResxFileNameKeys {

  /**
   * Common file names
   */
  const Breadcrumb = "breadcrumb";
  const MenuLeft = "menu_left";
  const WsDefaults = "ws_defaults";
  const Config = "config";
  const FileUpload = "fileupload";

}

?>
