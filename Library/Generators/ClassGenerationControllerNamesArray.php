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
 * @package ClassGenerationControllerNamesArray
 */

namespace Library\Generators;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class ClassGenerationControllerNamesArray extends ClassGenerationBase {

  /**
   * 
   * @param string $destinationDir
   * @param assoc array $params : the params composed the namespace and name of the class
   * @param array(of String) $data : list of controllers file names.
   */
  public function __construct($destinationDir, $params, $data) {
    $this->destinationDir = $destinationDir;
    $this->className = $params[ClassGenerationBase::ClassNameKey];
    $this->fileName = $this->className . ".php";
    $this->placeholders = Placeholders\PlaceholdersManager::InitPlaceholdersForPhpDoc($params);
    $this->data = $data;
    $this->classHeaderTemplateContents = file_exists(Templates\TemplateFileNameConstants::GetFullNameForConst(Templates\TemplateFileNameConstants::ClassHeaderTemplate));
  }

  public function BuildClass() {
    $this->WriteClassHeader();
    $this->WriteConstants();
    $this->WriteContent();
    $this->ClassEnd();
  }

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
