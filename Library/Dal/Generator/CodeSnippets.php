<?php

/**
 * List the template of code for the Dal generators.
 * 
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license		
 * @link		
 * @since		v1.0.0
 * @package		CodeSnippets
 */

namespace Library\Dal\Generator;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

class CodeSnippets {
  const SNIPPET_NAMESPACE_FRAMEWORK = "namespace {{namespace_framework}};";
  const SNIPPET_NAMESPACE_APP = "namespace {{namespace_app}};";
}