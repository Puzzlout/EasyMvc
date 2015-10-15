<?php

/**
 * Provides methods to process a given string template by replacing the placeholders
 * with the proper values.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package 
 */

namespace Library\GeneratorEngine;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class BaseTemplateProcessor {

  /**
   * @var resource a file pointer resource on success, or <b>FALSE</b> on error. 
   */
  protected $writer;

  /**
   * @var string : the content of /EasyMVC/CodeGenerators/templates/ClassHeaderTemplate.tt
   */
  public $classHeaderTemplateContents;

  /**
   * The list of placeholders for the various code snippets.
   * The first use is the Class Header PhpDoc.
   * @var array(of String) 
   */
  public $placeholders;

  protected function ProcessTemplate() {
    $output = strtr($this->classHeaderTemplateContents, $this->placeholders);
    fwrite($this->writer, $output);
  }

}
