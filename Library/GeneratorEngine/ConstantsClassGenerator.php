<?php

/**
 * Class that build the class with the array of files names as constants.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package ConstantsClassGenerator
 */

namespace Library\GeneratorEngine;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class ConstantsClassGenerator extends BaseClassGenerator {
  /**
   * Write the content of the class, method by method.
   */
  public function WriteContent() {
    $output = $this->WriteGetListMethod();
    $output .= CodeSnippets\PhpCodeSnippets::CRLF;
    $output .= $this->WriteDoesConstantExistMethod();
    fwrite($this->writer, $output);
  }

  /**
   * 
   * @return string : the code generated for the method
   */
  private function WriteGetListMethod() {
    $method = $this->GetMethodNameToGenerate(__FUNCTION__);
    $output = CodeSnippets\PhpCodeSnippets::TAB2 .
            CodeSnippets\PhpCodeSnippets::PublicStaticFunction . $method . "() {" . CodeSnippets\PhpCodeSnippets::LF .
            CodeSnippets\PhpCodeSnippets::TAB4 .
            "return array(" . CodeSnippets\PhpCodeSnippets::LF;

    foreach ($this->data as $value) {
      $valueCleaned = trim($value, ".php");

      $lineOfCode = CodeSnippets\PhpCodeSnippets::TAB8 . "self::" . $valueCleaned . BaseClassGenerator::Key . " => '" . $valueCleaned . "',";
      $output .= $lineOfCode . CodeSnippets\PhpCodeSnippets::LF;
    }
    $output .=
            CodeSnippets\PhpCodeSnippets::TAB4 . ");" . CodeSnippets\PhpCodeSnippets::LF .
            CodeSnippets\PhpCodeSnippets::TAB2 . "}";
    return $output;
  }

  /**
   * 
   * @return string : the code generated for the method
   */
  private function WriteDoesConstantExistMethod() {
    $method = $this->GetMethodNameToGenerate(__FUNCTION__);
    $output = CodeSnippets\PhpCodeSnippets::TAB2 .
            CodeSnippets\PhpCodeSnippets::PublicStaticFunction . $method . "(\$key) {" . CodeSnippets\PhpCodeSnippets::LF .
            CodeSnippets\PhpCodeSnippets::TAB4 .
            "return array_key_exists(\$key, self::GetList());" . CodeSnippets\PhpCodeSnippets::LF .
            CodeSnippets\PhpCodeSnippets::TAB2 . "}";
    return $output;
  }

}
