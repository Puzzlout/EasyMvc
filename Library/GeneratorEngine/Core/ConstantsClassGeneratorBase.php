<?php

/**
 * Class that build the class with the array of files names as constants.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ConstantsClassGeneratorBase
 */

namespace Library\GeneratorEngine\Core;

use Library\GeneratorEngine\CodeSnippets\PhpCodeSnippets;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class ConstantsClassGeneratorBase extends BaseClassGenerator implements IClassGenerator, IConstantClass {

  const DoGenerateConstantKeysKey = "DoGenerateConstantKeysKey";
  const DoGenerateGetListMethodKey = "DoGenerateGetListMethodKey";

  protected $DoGenerateConstantKeys = TRUE;
  protected $DoGenerateGetListMethod = TRUE;
  protected $ExtractedConstantsList = array();

  public function __construct($params, $data) {
    $this->fileName = $params[self::ClassNameKey] . ".php";
    $this->className = $params[self::ClassNameKey];
    parent::__construct($params, $data);
  }

  public function BuildClass() {
    parent::BuildClass();
  }

  /**
   * Build a string for a constant representing the key to find a folder in the
   * array of constants.
   * 
   * @param string $folderValue The value is a folder name
   * @return string
   */
  public function BuildConstantForFolderValue($folderValue) {
    return $folderValue . BaseClassGenerator::FolderSuffix;
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

  public function WriteAssociativeArrayValueAsNewArray($value, $tabAmount = 0) {
    return parent::WriteAssociativeArrayValueAsNewArray($value, $tabAmount);
  }

  public function WriteAssociativeArrayValueWithKeyAndValue($key, $value, $tabAmount = 0) {
    throw new \Library\Exceptions\NotImplementedException();
  }

  /**
   * Write the constants of the class to the output file.
   * 
   * @param string $valueToTrim the string value to remove from each value in
   * $this->data array.
   */
  public function WriteConstants($valueToTrim = ".php") {
    $extractor = \Library\Helpers\ArrayExtractionHelper::Init()->ExtractDistinctValues($this->data);
    $output = "";
    foreach ($extractor->List as $constant) {
      if (\Library\Helpers\RegexHelper::Init($constant)->IsAPhpFilename()) {
        $output .= $this->WriteConstant($this->BuildConstantKeyValue($constant, $valueToTrim));      
      } else {
        $output .= $this->WriteConstant($this->BuildConstantForFolderValue($constant));      
      }
    }
    $output .= PhpCodeSnippets::LF;
    fwrite($this->writer, $output);
  }

  public function WriteConstantsFromArray($array, $valueToTrim) {
    $output = "";
    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $output .= $this->WriteConstant($this->BuildConstantForFolderValue($key));
        $output .= $this->WriteConstantsFromArray($value, $valueToTrim);
      } else {
        $output .= $this->WriteConstant($this->CleanAndBuildConstantKeyValue($value, $valueToTrim));
      }
    }
    return $output;
  }

  /**
   * Write the content of the class, method by method.
   */
  public function WriteContent() {
    $output = $this->WriteGetListMethod();
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
        $output .= $this->WriteAssociativeArrayValue($this->RemoveExtensionFileName($value, ".php"), $tabAmount);
      }
    }
    if ($arrayOpened) {
      $output .= $this->CloseArray($tabAmount - 1);
    }
    return $output;
  }

}
