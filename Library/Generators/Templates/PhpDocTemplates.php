<?php

/**
 * List of functions returning a PhpDoc templates for a given case.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package PhpDocTemplates
 */

namespace Library\Generators\Templates;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class PhpDocTemplates {

  public static function HeaderClass() {
    return
            Library\Generators\CodeSnippets\PhpDocSnippets::OPENING . Library\Generators\CodeSnippets\PhpCodeSnippets::CRLF .
            Library\Generators\CodeSnippets\PhpDocSnippets::SINGLESTART . Library\Generators\CodeSnippets\PhpCodeSnippets::CRLF .
            Library\Generators\CodeSnippets\PhpDocSnippets::SINGLESTART .
            " List of functions returning a PhpDoc templates for a given case." .
            Library\Generators\CodeSnippets\PhpDocSnippets::SINGLESTART . Library\Generators\CodeSnippets\PhpCodeSnippets::CRLF .
// * @author Jeremie Litzler
// * @copyright Copyright (c) 2015
// * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
// * @link https://github.com/WebDevJL/EasyMVC
// * @since Version 1.0.0
// * @package PhpDocTemplates
// */
//";
            "";
  }

}
