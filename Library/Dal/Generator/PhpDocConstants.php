<?php

/**
 *
 * @package		Basic MVC framework
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 *  Constants Class
 *
 * @package		SqlToDao
 * @subpackage	
 * @category	
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Dal\Generator;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class PhpDocConstants {
  const OPENING = "/**";
  const SINGLESTART = "*";
  const CLOSING = "*/";
  const PACKAGE = "* @package {{phpdoc_package}}";
  const AUTHOR = "* @author {{phpdoc_author}}";
  const COPYRIGHT = "* @copyright Copyright (c) {{phpdoc_copyright_year}}";
  const LICENCE = "* @licence {{phpdoc_licence}}";
  const LINK = "* @link {{phpdoc_link}}";
  const SINCE = "* @since Version {{phpdoc_version_number}}";
  
  const SUBPACKAGE = "* @subpackage {{phpdoc_subpackage}}";
}