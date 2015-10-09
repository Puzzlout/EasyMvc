<?php

/**
 * Class with the properties needs to generate a class file.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package BaseClassGenerator
 */

namespace Library\GeneratorEngine;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class BaseClassGenerator {

  const NameSpaceKey = "NameSpaceKey";
  const ClassNameKey = "ClassNameKey";
  const DestinationDirKey = "DestinationDirKey";
  const Key = "Key";

  /**
   * @var resource a file pointer resource on success, or <b>FALSE</b> on error. 
   */
  protected $writer;

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
   * The list of placeholders for the various code snippets.
   * The first use is the Class Header PhpDoc.
   * @var array(of String) 
   */
  public $placeholders;

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
   * @var string : the content of /EasyMVC/CodeGenerators/templates/ClassHeaderTemplate.tt
   */
  public $classHeaderTemplateContents;
  
  
  /**
   * 
   * @param string $destinationDir
   * @param assoc array $params : the params composed the namespace and name of the class
   * @param array(of String) $data : list of controllers file names.
   */
  public function __construct($destinationDir, $params, $data) {
    $this->destinationDir = $destinationDir;
    $this->className = $params[self::ClassNameKey];
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
    fwrite($this->writer, "<?php" . CodeSnippets\PhpCodeSnippets::CRLF);
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
    $output = CodeSnippets\PhpDocSnippets::OPENING . CodeSnippets\PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::AUTHOR, $this->placeholders) . CodeSnippets\PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::COPYRIGHT, $this->placeholders) . CodeSnippets\PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::LICENCE, $this->placeholders) . CodeSnippets\PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::LINK, $this->placeholders) . CodeSnippets\PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::SINCE, $this->placeholders) . CodeSnippets\PhpCodeSnippets::LF .
            strtr(CodeSnippets\PhpDocSnippets::PACKAGE, $this->placeholders) . CodeSnippets\PhpCodeSnippets::LF .
            CodeSnippets\PhpDocSnippets::CLOSING . CodeSnippets\PhpCodeSnippets::LF;
    fwrite($this->writer, $output);
  }

  /**
   * Writes the line to prevent direct execution of the PHP class.
   */
  public function AddScriptNotAllowedLine() {
    $output = CodeSnippets\PhpCodeSnippets::LF .
            "if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }" .
            CodeSnippets\PhpCodeSnippets::CRLF;
    fwrite($this->writer, $output);
  }

  /**
   * Writes the start of the class.
   */
  public function ClassStart() {
    $output = CodeSnippets\PhpCodeSnippets::CRLF .
            "class " . ucfirst($this->className) . " {" . //" extends " . $this->baseClass . " {" .
            CodeSnippets\PhpCodeSnippets::LF;
    fwrite($this->writer, $output);
  }

  /**
   * Closes the class.
   */
  public function ClassEnd() {
    fwrite($this->writer, CodeSnippets\PhpCodeSnippets::LF . "}");
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
    $this->AddPhpOpenTag();
    $this->AddFileDescription();
    $this->AddNameSpace();
    $this->AddScriptNotAllowedLine();
    $this->ClassStart();
  }

    /**
   * Write the constants of the class if any must be created.
   */
  public function WriteConstants($valueToTrim = ".php") {
    $output = "";
    foreach ($this->data as $value) {
      $valueCleaned = trim($value, $valueToTrim) . BaseClassGenerator::Key;
      $lineOfCode = CodeSnippets\PhpCodeSnippets::TAB2 .
              "const " . $valueCleaned .
              " = '" .
              $valueCleaned . "';" .
              CodeSnippets\PhpCodeSnippets::LF;
      $output .= $lineOfCode;
    }
    $output .= CodeSnippets\PhpCodeSnippets::LF;
    fwrite($this->writer, $output);
  }

  public function WriteContent() {
    
  }

  public function GetMethodNameToGenerate($dynamicMethod) {
    return str_replace(array("Write", "Method"), "", $dynamicMethod);
  }
}
