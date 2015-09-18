<?php

/**
 * List the template of php code for file generators.
 * 
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package PhpCodeSnippets
 */

namespace Library\Generators\CodeSnippets;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class PhpCodeSnippets {

  /**
   * The carriage return constant.
   */
  const CRLF = "\n\r";

  /**
   * The break line constant.
   */
  const LF = "\r";

  /**
   * The equivalent of one tab.
   */
  const TAB2 = "  ";

  /**
   * The equivalent of 2 tabs.
   */
  const TAB4 = "    ";

  /**
   * The equivalent of 3 tabs.
   */
  const TAB6 = "      ";

  /**
   * The equivalent of 4 tabs.
   */
  const TAB8 = "        ";

  /**
   * public static function snippet
   */
  const PublicStaticFunction = "public static function ";
}
