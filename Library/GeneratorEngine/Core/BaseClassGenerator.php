<?php

/**
 * Class with the properties needs to generate a class file.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package BaseClassGenerator
 */

namespace Library\GeneratorEngine\Core;

use Library\GeneratorEngine\CodeSnippets\PhpCodeSnippets;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class BaseClassGenerator extends BaseTemplateProcessor implements IClassGenerator {

  /**
   * 
   * @param string $destinationDir
   * @param assoc array $params : the params composed the namespace and name of the class
   * @param array(of String) $data : list of controllers file names.
   */
  public function __construct($params, $data) {
    $this->destinationDir = FrameworkConstants_RootDir . $params[BaseClassGenerator::DestinationDirKey];
    $this->className = array_key_exists(self::ClassDerivation, $params) ?
            $params[self::ClassNameKey] . " extends " . $params[self::ClassDerivation] :
            $params[self::ClassNameKey];
    $this->fileName = array_key_exists(self::CultureKey, $params) ?
            $params[self::ClassNameKey] . "." . $params[self::CultureKey] . ".php" :
            $params[self::ClassNameKey] . ".php";
    $params[self::ClassNameKey] = $this->className;
    $this->placeholders = \Library\GeneratorEngine\Placeholders\PlaceholdersManager::InitPlaceholdersForPhpDoc($params);
    $this->data = $data;
    $templateHeader = \Library\GeneratorEngine\Templates\TemplateFileNameConstants::GetFullNameForConst(\Library\GeneratorEngine\Templates\TemplateFileNameConstants::ClassHeaderTemplate);
    $this->classHeaderTemplateContents = file_exists($templateHeader) ?
            file_get_contents($templateHeader) : FALSE;
  }

  /**
   * Cleans a file name from its extension and build the key string value to find
   * its value in the array of constants.
   * @param type $rawValue
   * @param type $valueToTrim
   * @return type
   */
  protected function CleanAndBuildConstantKeyValue($rawValue, $valueToTrim) {
    $valueCleaned = $this->RemoveExtensionFileName($rawValue, $valueToTrim);
    return $this->BuildConstantKeyValue($valueCleaned);
  }

  /**
   * Remove extension of filename.
   * 
   * @param string $filename
   * @param string $extension
   * @return string the extensionless filename
   */
  protected function RemoveExtensionFileName($filename, $extension) {
    //WARNING: the function trim does weird thing so prefer using str_replace
    //ex: if we have a filename "popupsomething.php" where we want the extension
    //to be removed, the trimmed result will be "opupsomething".
    return str_replace($extension, "", $filename);
  }

  public function BuildClass() {
    $this->OpenWriter();
    $this->WriteClassHeader();
    $this->WriteConstants();
    $this->WriteContent();
    $this->ClassEnd();
    $this->CloseWriter();
  }

  /**
   * Build a string for a constant representing the key to find a folder in the
   * array of constants.
   * 
   * @param string $value the value that will make the constant name with self::Key suffix
   * @return string the computed value
   */
  public function BuildConstantKeyValue($value) {
    return $value . self::Key;
  }

  /**
   * Closes the class.
   */
  public function ClassEnd() {
    fwrite($this->writer, PhpCodeSnippets::LF . "}");
  }

  /**
   * Closes handle of file opened.
   */
  public function CloseWriter() {
    fclose($this->writer);
  }

  /**
   * 
   * @param string $dynamicMethod the template method to build the final method
   * name from.
   * 
   * @return string the computed method name.
   */
  public function GetMethodNameToGenerate($dynamicMethod) {
    return str_replace(array("Write", "Method"), "", $dynamicMethod);
  }

  /**
   * Opens handle to write to target file.
   */
  public function OpenWriter() {
    $filePath = $this->destinationDir . $this->fileName;
    $this->writer = fopen($filePath, 'w') or die("can't open file $filePath.");
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
            $value . self::Key . " => '" . $value . "'," .
            PhpCodeSnippets::LF;
    return $lineOfCode;
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
            $value . self::FolderKey . " => array(" .
            PhpCodeSnippets::LF;
    return $lineOfCode;
  }

  public function WriteAssociativeArrayValueWithKeyAndValue($key, $value, $tabAmount = 0) {
    throw new \Library\Exceptions\NotImplementedException();
  }

  /**
   * Writes the class header:
   */
  public function WriteClassHeader() {
    $this->ProcessTemplate();
  }

  /**
   * Builds a line of code that declare a constant.
   * @param string $value
   * @return string a line of code representing a constant declaration
   */
  public function WriteConstant($value) {
    $lineOfCode = PhpCodeSnippets::TAB2 .
            "const " . $value .
            " = '" .
            $value . "';" .
            PhpCodeSnippets::LF;
    return $lineOfCode;
  }

  public function WriteContent() {
    throw new \Library\Exceptions\NotImplementedException();
  }

  public function WriteNewArrayAndItsContents($array, $arrayOpened = FALSE, $tabAmount = 0) {
    throw new \Library\Exceptions\NotImplementedException();
  }

}
