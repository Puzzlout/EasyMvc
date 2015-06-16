<?php

/**
 *
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license		
 * @link		
 * @since		v1.0.0
 * @package		
 * @subpackage	
 */

namespace Library\Dal\Generator;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class PhpDocPlaceholder {
  const AUTHOR = "{{phpdoc_author}}";
  const PACKAGE = "{{phpdoc_package}}";
  const COPYRIGHT_YEAR = "{{phpdoc_copyright_year}}";
  const LICENCE = "{{phpdoc_licence}}";
  const LINK = "{{phpdoc_link}}";
  const VERSION_NUMBER = "{{phpdoc_version_number}}";
  const SUBPACKAGE = "{{phpdoc_subpackage}}";
}