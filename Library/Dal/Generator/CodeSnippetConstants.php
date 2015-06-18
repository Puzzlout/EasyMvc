<?php

/**
 * List the template of code for the Dal generators.
 * 
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license		
 * @link		
 * @since		v1.0.0
 * @package		CodeSnippetConstants
 */

namespace Library\Dal\Generator;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class CodeSnippetConstants {
  const NAMESPACE_FRAMEWORK = "{{namespace_framework}}";
  const NAMESPACE_APP = "{{namespace_app}}";
  const CLASS_NAME = "{{class_name}}";
  const PROPERTY_NAME_FIRST_CAP = "{{property_name_first_cap}}";
  const PROPERTY_NAME = "{{property_name}}";
  
}