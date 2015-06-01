<?php
/**
 *
 * @package		The Loffy Framework
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * QueryStringKeys Class
 *
 * @package		Library
 * @subpackage	Enums
 * @category	QueryStringKeys
 * @author		Jeremie Litzler
 * @link		
 */
namespace Library\Enums;
if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');

/**
 * Lists all the SessionKeys used throughout the applications so that we don't use hard-coded strings.
 */
abstract class QueryStringKeys {
  const EditionMode = "mode";
  const EditionModeAdd = "add";
  const EditionModeEdit = "edit";
}

?>
