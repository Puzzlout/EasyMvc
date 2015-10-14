<?php

/**
 * List of constants representing code snippets for PhpDoc usage.
 * 
* @author Jeremie Litzler
* @copyright Copyright (c) 2015
* @licence http://opensource.org/licenses/gpl-license.php GNU Public License
* @link https://github.com/WebDevJL/
* @since Version 1.0.0
* @package PhpDocSnippets
*/

namespace Library\GeneratorEngine\CodeSnippets;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class PhpDocSnippets {
  const OPENING = "/**";
  const SINGLESTART = "*";
  const CLOSING = "*/";
  const PACKAGE = "* @package {{phpdoc_package}}";
  const AUTHOR = "* @author {{phpdoc_author}}";
  const COPYRIGHT = "* @copyright Copyright (c) {{phpdoc_copyright_year}}";
  const LICENCE = "* @licence {{phpdoc_licence}}";
  const LINK = "* @link {{phpdoc_link}}";
  const SINCE = "* @since Version {{phpdoc_version_number}}";
  const SET_PROPERTY_SUMMARY = "* Sets {{phpdoc_property_set}}.";
  const GET_PROPERTY_SUMMARY = "* Gets {{phpdoc_property_get}}.";
  const SUBPACKAGE = "* @subpackage {{phpdoc_subpackage}}";
}