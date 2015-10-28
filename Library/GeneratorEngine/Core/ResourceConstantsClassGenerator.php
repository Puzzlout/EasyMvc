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

namespace Library\GeneratorEngine\Core;

use Library\GeneratorEngine\CodeSnippets\PhpCodeSnippets;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ResourceConstantsClassGenerator extends ConstantsClassGenerator implements IClassGenerator, IConstantClass {

  public function __construct($params, $data) {
    parent::__construct($params, $data);
    $this->fileName = !is_null($params[self::CultureKey]) ?
            $params[self::ClassNameKey] . "_" . $params[self::CultureKey] . ".php" :
            $params[self::ClassNameKey] . ".php";
    $this->className = str_replace(".php", "", $this->fileName) .
            " extends " .
            $params[self::ClassDerivation];
    $params[self::ClassNameKey] = $this->className ;
    $this->placeholders = \Library\GeneratorEngine\Placeholders\PlaceholdersManager::InitPlaceholdersForPhpDoc($params);
    $this->DoGenerateConstantKeys = array_key_exists(ConstantsClassGenerator::DoGenerateConstantKeysKey, $params) ?
            $params[ConstantsClassGenerator::DoGenerateConstantKeysKey] :
            FALSE;
    $this->DoGenerateGetListMethod = array_key_exists(ConstantsClassGenerator::DoGenerateGetListMethodKey, $params) ?
            $params[ConstantsClassGenerator::DoGenerateGetListMethodKey] :
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
   * Closes a opened array.
   * 
   * @param int $tabAmount the number of tabs or 2 spaces to print.
   * @return string the code generated.
   */
  public function CloseArray($tabAmount = 0) {
    return
            str_repeat("  ", $tabAmount) .
            "),";
  }

  /**
   * Computes a value of an associative array.
   * 
   * @param string $value the value to use to compute the output
   * @return string the computed string
   */
  public function WriteAssociativeArrayValueAsNewArray($value, $tabAmount = 0) {
    $lineOfCode = str_repeat("  ", $tabAmount) .
            "self::" .
            $value . self::Key . " => array(" .
            PhpCodeSnippets::LF;
    return $lineOfCode;
  }

  /**
   * Computes a value of an associative array.
   * 
   * @param string $value the value to use to compute the output
   * @return string the computed string
   */
  public function WriteAssociativeArrayValueWithKeyAndValue($key, $value, $tabAmount = 0) {
    $lineOfCode = str_repeat("  ", $tabAmount) .
            "self::" .
            $key . self::Key . " => \"" . utf8_encode($value) . "\"," .
            PhpCodeSnippets::LF;
    return $lineOfCode;
  }

  /**
   * Write the constants of the class to the output file.
   * 
   * @param string $valueToTrim the string value to remove from each value in
   * $this->data array.
   */
  public function WriteConstants($valueToTrim = ".php") {
    $output = "";
    foreach ($this->data as $key => $value) {
      if (!is_array($value)) {
        $output .= $this->WriteConstant($this->BuildConstantKeyValue($key, $valueToTrim));
      } else {
        $output .= $this->WriteConstant($this->BuildConstantKeyValue($key));
        $output .= $this->WriteConstantsFromArray($value, $valueToTrim);
      }
    }
    $output .= PhpCodeSnippets::LF;
    fwrite($this->writer, $output);
  }

  public function WriteConstantsFromArray($array, $valueToTrim) {
    $output = "";
    foreach ($array as $key => $value) {
      $output .= $this->WriteConstant($this->BuildConstantKeyValue($key));
    }
    return $output;
  }

  /**
   * Write the content of the class, method by method.
   */
  public function WriteContent() {
    $output = $this->WriteGetListMethod();
    $output .= PhpCodeSnippets::CRLF;
    fwrite($this->writer, $output);
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
  public function WriteNewArrayAndItsContents($array, $arrayOpened = FALSE, $tabAmount = 0) {
    $output = "";
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $output .= $this->WriteAssociativeArrayValueAsNewArray($key, $tabAmount); //new array opened
        $output .= $this->WriteNewArrayAndItsContents($value, TRUE, $tabAmount);
      } else {
        $output .= $this->WriteAssociativeArrayValueWithKeyAndValue($key, $value, $tabAmount);
      }
    }
    if ($arrayOpened) {
      $output .= $this->CloseArray($tabAmount - 1);
    }
    return $output;
  }

}
