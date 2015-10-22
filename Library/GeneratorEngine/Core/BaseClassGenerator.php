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

class BaseClassGenerator extends BaseTemplateProcessor {

  const NameSpaceKey = "NameSpaceKey";
  const ClassNameKey = "ClassNameKey";
  const DestinationDirKey = "DestinationDirKey";
  const Key = "Key";
  const FolderKey = "FolderKey";
  const ClassDescriptionKey = "ClassDescriptionKey";
  const CultureKey = "CultureKey";
  const DataIsResources = "DataIsResourcesKey";

  /**
   * The path where the class file generated must be saved.
   * @var string 
   */
  public $destinationDir;

  /**
   * The Class name.
   * @var string 
   */
  public $className;

  /**
   * The computed value of $className with the extension ".php".
   * @var string 
   */
  public $fileName;

  /**
   * The data to use to write the content of the class.
   * @var array(of String)  
   */
  public $data;

  /**
   * The flag to know if the class is a framework and application class.
   */
  public $isFrameworkClass = true;

  /**
   * The data is either a list of files and folders or a list of resources.
   * @var bool
   */
  public $dataIsResources = false;

  /**
   * 
   * @param string $destinationDir
   * @param assoc array $params : the params composed the namespace and name of the class
   * @param array(of String) $data : list of controllers file names.
   */
  public function __construct($params, $data) {
    $this->destinationDir = FrameworkConstants_RootDir . $params[BaseClassGenerator::DestinationDirKey];
    $this->className = $params[self::ClassNameKey];
    $this->fileName = array_key_exists(self::CultureKey, $params) ? $this->className . "." . $params[self::CultureKey] . ".php" : $this->className . ".php";
    $this->placeholders = \Library\GeneratorEngine\Placeholders\PlaceholdersManager::InitPlaceholdersForPhpDoc($params);
    $this->data = $data;
    $templateHeader = \Library\GeneratorEngine\Templates\TemplateFileNameConstants::GetFullNameForConst(\Library\GeneratorEngine\Templates\TemplateFileNameConstants::ClassHeaderTemplate);
    $this->classHeaderTemplateContents = file_exists($templateHeader) ?
            file_get_contents($templateHeader) : FALSE;
  }

  public function BuildClass() {
    $this->WriteClassHeader();
    $this->WriteConstants();
    $this->WriteContent();
    $this->ClassEnd();
  }

  /**
   * Opens handle to write to target file.
   */
  public function OpenWriter() {
    $filePath = $this->destinationDir . $this->fileName;
    $this->writer = fopen($filePath, 'w') or die("can't open file $filePath.");
  }

  /**
   * Closes handle of file opened.
   */
  public function CloseWriter() {
    fclose($this->writer);
  }

  /**
   * Writes the PHP opening tag of PHP file.
   */
  public function AddPhpOpenTag() {
    fwrite($this->writer, "<?php" . PhpCodeSnippets::CRLF);
  }

  /**
   * Computes the namespace and writes it to the output.
   */
  public function AddNameSpace() {
    $output = "";
    if ($this->isFrameworkClass) {
      $output = strtr(CodeSnippets\ClassFileSnippets::SNIPPET_NAMESPACE_FRAMEWORK, $this->placeholders);
    } else {
      $output = strtr(CodeSnippets\ClassFileSnippets::SNIPPET_NAMESPACE_APP, $this->placeholders);
    }
    fwrite($this->writer, $output);
  }

  /**
   * Computes the class description using PhpDoc and writes it to the output.
   */
  public function AddFileDescription() {
    $output = CodeSnippets\PhpDocSnippets::OPENING . PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::AUTHOR, $this->placeholders) . PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::COPYRIGHT, $this->placeholders) . PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::LICENCE, $this->placeholders) . PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::LINK, $this->placeholders) . PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::SINCE, $this->placeholders) . PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::PACKAGE, $this->placeholders) . PhpCodeSnippets::LF .
            CodeSnippets\PhpDocSnippets::CLOSING . PhpCodeSnippets::LF;
    fwrite($this->writer, $output);
  }

  /**
   * Writes the line to prevent direct execution of the PHP class.
   */
  public function AddScriptNotAllowedLine() {
    $output = PhpCodeSnippets::LF .
            "if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }" .
            PhpCodeSnippets::CRLF;
    fwrite($this->writer, $output);
  }

  /**
   * Writes the start of the class.
   */
  public function ClassStart() {
    $output = PhpCodeSnippets::CRLF .
            "class " . ucfirst($this->className) . " {" . //" extends " . $this->baseClass . " {" .
            PhpCodeSnippets::LF;
    fwrite($this->writer, $output);
  }

  /**
   * Closes the class.
   */
  public function ClassEnd() {
    fwrite($this->writer, PhpCodeSnippets::LF . "}");
    $this->CloseWriter();
  }

  /**
   * Writes the class header:
   *  - PHP opening tag, 
   *  - PhpDoc of the class, 
   *  - Class namespace, 
   *  - Not allowed script line and 
   *  - Class start line.
   * 
   * @param type $table_name : The database table name used to name the class.
   */
  public function WriteClassHeader() {
    $this->OpenWriter();
    if (is_string($this->classHeaderTemplateContents)) {
      $this->ProcessTemplate();
    } else {
      $this->AddPhpOpenTag();
      $this->AddFileDescription();
      $this->AddNameSpace();
      $this->AddScriptNotAllowedLine();
      $this->ClassStart();
    }
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
      if (!is_array($value) && preg_match("`^.*php$`", $value)) {
        $output .= $this->WriteConstant($this->CleanAndBuildConstantKeyValue($value, $valueToTrim));
      } else {
        $output .= $this->WriteConstant($this->BuildConstantFolderKeyValue($key));
        $output .= $this->WriteConstantsFromArray($value, $valueToTrim);
      }
    }
    $output .= PhpCodeSnippets::LF;
    fwrite($this->writer, $output);
  }

  /**
   * Write the constants of the class if any must be created when the data is 
   * a list of resources.
   */
  public function WriteConstantsForResources($valueToTrim = "") {
    $output = "";
    foreach ($this->data as $key => $value) {
      $output .= $this->WriteConstant($this->BuildConstantKeyValue($key));
    }
    $output .= PhpCodeSnippets::LF;
    fwrite($this->writer, $output);
  }

  /**
   * Resurcive loop to write constants.
   * 
   * @param array $array
   * @param string $valueToTrim
   */
  protected function WriteConstantsFromArray($array, $valueToTrim) {
    
  }

  protected function WriteConstant($value) {
    $lineOfCode = PhpCodeSnippets::TAB2 .
            "const " . $value .
            " = '" .
            $value . "';" .
            PhpCodeSnippets::LF;
    return $lineOfCode;
  }

  /**
   * Implementation varies. See the derived class.
   */
  public function WriteContent() {
    
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
   * Build a string for a constant representing the key to find a folder in the
   * array of constants.
   * 
   * @param string $value the value is a filename without its extension
   * @see CleanAndBuildConstantKeyValue function
   * @return string
   */
  protected function BuildConstantKeyValue($value) {
    return $value . BaseClassGenerator::Key;
  }

  /**
   * Build a string for a constant representing the key to find a folder in the
   * array of constants.
   * 
   * @param srting $folderValue the value is a folder name
   * @return string
   */
  protected function BuildConstantFolderKeyValue($folderValue) {
    return $folderValue . BaseClassGenerator::FolderKey;
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
   * Computes a value of an associative array.
   * 
   * @param string $key the key to use to compute the output in some cases
   * @param string $value the value to use to compute the output
   * @param int $tabAmount the amount of tabulations to print in the computed output
   * @return string the computed string
   */
  protected function WriteAssociativeArrayValue($key, $value, $tabAmount = 0) {
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
  protected function WriteAssociativeArrayValueAsNewArray($value, $tabAmount = 0) {
    $lineOfCode = str_repeat("  ", $tabAmount) .
            "self::" .
            $value . self::FolderKey . " => array(" .
            PhpCodeSnippets::LF;
    return $lineOfCode;
  }

}
