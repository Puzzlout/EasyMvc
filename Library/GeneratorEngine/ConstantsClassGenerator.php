<?php

/**
 * Class that build the class with the array of files names as constants.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
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
    parent::WriteContent();
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

    foreach ($this->data as $key => $value) {
      if (!is_array($value) && preg_match("`^.*php$`", $value)) {
        //write associative value in array
        $output .= $this->WriteAssociativeArrayValue($this->RemoveExtensionFileName($value, ".php"), 3);
      } else {
        //write a new array and its contents
        $output .= $this->WriteAssociativeArrayValueAsNewArray($key, 3);
        $output .= $this->WriteNewArrayAndItsContents($value, TRUE, 4);
        //$output .= $this->CloseArray(count($value), 4);
      }
      $output .= CodeSnippets\PhpCodeSnippets::LF;
    }
    $output .=
            CodeSnippets\PhpCodeSnippets::TAB4 . ");" . CodeSnippets\PhpCodeSnippets::LF .
            CodeSnippets\PhpCodeSnippets::TAB2 . "}";
    return $output;
  }

  /**
   * Recursively writes an array from an array of values.
   * 
   * @param array $array the array to loop through to generate the values given.
   * @param type $arrayOpened flag to specify if an array is opened and needs to
   * be closed before moving on.
   * @param type $tabAmount the number of tabs or 2 spaces to print in the generated
   * code.
   * @return string the code generated.
   */
  protected function WriteNewArrayAndItsContents($array, $arrayOpened = FALSE, $tabAmount = 0) {
    $output = "";
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $output .= $this->WriteAssociativeArrayValueAsNewArray($key, $tabAmount); //new array opened
        $output .= $this->WriteNewArrayAndItsContents($value, TRUE, $tabAmount);
      } else {
        $output .= $this->WriteAssociativeArrayValue($this->RemoveExtensionFileName($value, ".php"), $tabAmount);
      }
    }
    if ($arrayOpened) {
      $output .= $this->CloseArray($tabAmount - 1);
    }
    return $output;
  }

  /**
   * Closes a opened array.
   * 
   * @param int $tabAmount the number of tabs or 2 spaces to print.
   * @return string the code generated.
   */
  protected function CloseArray($tabAmount = 0) {
    return
            str_repeat("  ", $tabAmount) .
            "),";
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

  protected function WriteConstantsFromArray($array, $valueToTrim) {
    $output = "";
    parent::WriteConstantsFromArray($array, $valueToTrim);
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $output .= $this->WriteConstant($this->BuildConstantFolderKeyValue($key));
        $output .= $this->WriteConstantsFromArray($value, $valueToTrim);
      } else {
        $output .= $this->WriteConstant($this->CleanAndBuildConstantKeyValue($value, $valueToTrim));
      }
    }
    return $output;
  }

}
