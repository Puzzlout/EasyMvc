<?php

/**
 * Class that build the class with a list of constants representing the names of
 * each controller.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ConstantsAndListClassGenerator
 */

namespace Library\GeneratorEngine\Core;

use Library\GeneratorEngine\CodeSnippets\PhpCodeSnippets;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ConstantsAndListClassGenerator extends ConstantsClassGeneratorBase implements IClassGenerator, IConstantClass {

  public function __construct($params, $data) {
    parent::__construct($params, $data);
    $this->DoGenerateConstantKeys = array_key_exists(ConstantsClassGeneratorBase::DoGenerateConstantKeysKey, $params) ?
            $params[ConstantsClassGeneratorBase::DoGenerateConstantKeysKey] :
            FALSE;
    $this->DoGenerateGetListMethod = array_key_exists(ConstantsClassGeneratorBase::DoGenerateGetListMethodKey, $params) ?
            $params[ConstantsClassGeneratorBase::DoGenerateGetListMethodKey] :
            FALSE;
  }

  public function BuildClass() {
    parent::OpenWriter();
    parent::WriteClassHeader();
    if ($this->DoGenerateConstantKeys) {
      $this->WriteConstants();
    }
    if ($this->DoGenerateGetListMethod) {
      $this->WriteContent();
    }
    parent::ClassEnd();
    parent::CloseWriter();
  }

  /**
   * Computes a value of an associative array.
   * 
   * @param string $value the value to use to compute the output
   * @param int $tabAmount the amount of tabulations to print in the computed output
   * @return string the computed string
   */
  public function WriteAssociativeArrayValue($value, $tabAmount = 0) {
    $lineOfCode = str_repeat("  ", $tabAmount) .
            "self::" .
            $value . " => '" . $value . "',";
    return $lineOfCode;
  }

  /**
   * 
   * @return string : the code generated for the method
   */
  public function WriteGetListMethod() {
    $method = $this->GetMethodNameToGenerate(__FUNCTION__);
    $output = PhpCodeSnippets::TAB2 .
            PhpCodeSnippets::PublicStaticFunction . $method . "() {" . PhpCodeSnippets::LF .
            PhpCodeSnippets::TAB4 .
            "return array(" . PhpCodeSnippets::LF;

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
      $output .= PhpCodeSnippets::LF;
    }
    $output .=
            PhpCodeSnippets::TAB4 . ");" . PhpCodeSnippets::LF .
            PhpCodeSnippets::TAB2 . "}";
    return $output;
  }
}
