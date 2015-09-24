<?php

/**
 * Class that build the class with the array of controller names to look up 
 * when a web request is made.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package ClassGeneratorForControllerList
 */

namespace Library\GeneratorEngine;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class ClassGeneratorForControllerList extends ClassGenerationBase {
  /**
   * Write the content of the class, method by method.
   */
  public function WriteContent() {
    $output = $this->WriteGetListMethod();
    $output .= CodeSnippets\PhpCodeSnippets::CRLF;
    $output .= $this->WriteDoesControllerExistMethod();
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

      $lineOfCode = CodeSnippets\PhpCodeSnippets::TAB8 . "self::" . $valueCleaned . ClassGenerationBase::Key . " => '" . $valueCleaned . "',";
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
  private function WriteDoesControllerExistMethod() {
    $method = $this->GetMethodNameToGenerate(__FUNCTION__);
    $output = CodeSnippets\PhpCodeSnippets::TAB2 .
            CodeSnippets\PhpCodeSnippets::PublicStaticFunction . $method . "(\$key) {" . CodeSnippets\PhpCodeSnippets::LF .
            CodeSnippets\PhpCodeSnippets::TAB4 .
            "return array_key_exists(\$key, self::GetList());" . CodeSnippets\PhpCodeSnippets::LF .
            CodeSnippets\PhpCodeSnippets::TAB2 . "}";
    return $output;
  }

}
