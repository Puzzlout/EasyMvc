<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dao_generator
 *
 * @author x666207
 */

namespace Library\Dal\Generator;

class DaoClassGenerator {

  protected $className, $fileName, $dir, $writer;
  public $file_contents;
  private $_CRLF = "\n\r", $_LF = "\r", $_TAB2 = "  ", $_TAB4 = "    ", $_TAB6 = "      ", $_TAB8 = "        ";
  private $placeholders;
  private $isFrameworkClass = true;
  private $baseClass = "\Library\Entity";

  public function __construct($params) {
    $this->dir = $params["dir"];
    $this->fileName = $params["file_name"];
    $this->className = trim($this->fileName,".php");
    $this->placeholders = array(
        PhpDocPlaceholder::AUTHOR => "Jeremie Litzler",
        PhpDocPlaceholder::COPYRIGHT_YEAR => date("Y"),
        PhpDocPlaceholder::LICENCE => "",
        PhpDocPlaceholder::LINK => "",
        PhpDocPlaceholder::PACKAGE => $this->fileName,
        PhpDocPlaceholder::SUBPACKAGE => "",
        PhpDocPlaceholder::VERSION_NUMBER => __VERSION_NUMBER__,
        "{{namespace_framework}}" => "\\Library\\Dal\\Modules\\",
        "{{namespace_app}}" => "\\Applications\\". __APPNAME__ ."\\Models\\Dao\\"
    );
    $this->isFrameworkClass = $params["type"] === \Library\Enums\GenericAppKeys::APP_DB_TABLE ? FALSE : TRUE;
  }

  public function OpenWriter() {
    $filePath = $this->dir . $this->fileName;
    echo $filePath . "<br />";

    $this->writer = fopen($filePath, 'w') or die("can't open file");
  }

  public function CloseWriter($params) {
    fclose($this->writer);
  }

  public function AddPhpOpenTag() {
    fwrite($this->writer, "<?php" . $this->_CRLF);
  }

  public function AddNameSpace() {
    if($this->isFrameworkClass) {
      fwrite($this->writer, strtr(CodeSnippets::SNIPPET_NAMESPACE_FRAMEWORK, $this->placeholders) . $this->className);
    } else {
      fwrite($this->writer, strtr(CodeSnippets::SNIPPET_NAMESPACE_APP, $this->placeholders) . $this->className);
    }
    
  }

  public function AddFileDescription($table_name) {
    fwrite($this->writer, PhpDocConstants::OPENING . $this->_LF . PhpDocConstants::SINGLESTART . $this->_LF);
    fwrite($this->writer, strtr(PhpDocConstants::AUTHOR, $this->placeholders) . $this->_LF);
    fwrite($this->writer, strtr(PhpDocConstants::COPYRIGHT, $this->placeholders) . $this->_LF);
    fwrite($this->writer, strtr(PhpDocPlaceholder::LICENCE, $this->placeholders) . $this->_LF);
    fwrite($this->writer, strtr(PhpDocConstants::LINK, $this->placeholders) . $this->_LF);
    fwrite($this->writer, strtr(PhpDocConstants::SINCE, $this->placeholders) . $this->_LF);
    fwrite($this->writer, strtr(PhpDocConstants::PACKAGE, $this->placeholders) . $this->_LF);
    fwrite($this->writer, PhpDocConstants::CLOSING . $this->_CRLF);
  }

  public function AddScriptNotAllowedLine() {
    fwrite($this->writer, $this->_LF . "if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) { exit('No direct script access allowed'); }");
  }

    public function ClassStart() {
    $output = $this->_CRLF . "class " . ucfirst($this->className) . " extends " . $this->baseClass  . " {". $this->_LF;
    fwrite($this->writer, $output);
  }

  public function ClassEnd() {
    fwrite($this->writer, $this->_LF . "}");
  }

  public function BuildClassHeader($table_name) {
    $this->OpenWriter();
    $this->AddPhpOpenTag();
    $this->AddFileDescription($table_name);
    $this->AddNameSpace();
    $this->AddScriptNotAllowedLine();
    $this->ClassStart();
  }

  public function BuildClassBody($table_col_metas) {
    //Build the properties
    $this->AddPropertiesAndConsts($table_col_metas);
    //Add setters
    $this->AddSetters($table_col_metas);
    //Add getters
    $this->AddGetters($table_col_metas);
  }

  private function AddPropertiesAndConsts($columns) {
    //Write the public properties
    fwrite($this->writer, $this->_TAB2 . "public " . $this->_LF);
    $columnCount = 0;
    foreach ($columns as $columnName => $columnMeta) {
      if (count($columns) - 1 === $columnCount) {
        fwrite($this->writer, $this->_TAB4 . "$" . $columnMeta[0]["Field"] . ";" . $this->_CRLF);
      } else {
        fwrite($this->writer, $this->_TAB4 . "$" . $columnMeta[0]["Field"] . "," . $this->_LF);
      }
      $columnCount += 1;
    }
    //Write the constants
    fwrite($this->writer, $this->_TAB2 . "const " . $this->_LF);
    $columnCount = 0;
    foreach ($columns as $columnName => $columnMeta) {
      if (count($columns) - 1 === $columnCount) {
        fwrite($this->writer, $this->_TAB4 . strtoupper($columnMeta[0]["Field"]) . "_ERR = " . $columnCount . ";" . $this->_CRLF);
      } else {
        fwrite($this->writer, $this->_TAB4 . strtoupper($columnMeta[0]["Field"]) . "_ERR = " . $columnCount . "," . $this->_LF);
      }
      $columnCount += 1;
    }
  }

  private function AddSetters($columns) {
    fwrite($this->writer, $this->_TAB2 . "// SETTERS //" . $this->_LF);
    foreach ($columns as $columnName => $columnMeta) {
      $output = $this->_TAB2 . "public function set" . ucfirst($columnMeta[0]["Field"]) . "($" . $columnMeta[0]["Field"] . ") {" . $this->_LF;
      //$output .= $this->_TAB4 . "if (empty($" . $column_name . ")) {" . $this->_LF;
      //$output .= $this->_TAB6 . '$this->erreurs[] = self::' . strtoupper($column_name) . '_ERR;' . $this->_LF;
      //$output .= $this->_TAB4 . "} else {" . $this->_LF;
      $output .= $this->_TAB6 . '$this->' . $columnMeta[0]["Field"] . ' = $' . $columnMeta[0]["Field"] . ';' . $this->_LF;
      //$output .= $this->_TAB4 . "}" . $this->_LF;
      $output .= $this->_TAB2 . "}" . $this->_CRLF;
      fwrite($this->writer, $output);
    }
  }

  private function AddGetters($columns) {
    fwrite($this->writer, $this->_TAB2 . "// GETTERS //" . $this->_LF);
    foreach ($columns as $columnName => $columnMeta) {
      $output = $this->_TAB2 . "public function " . $columnMeta[0]["Field"] . "() {" . $this->_LF;
      $output .= $this->_TAB4 . 'return $this->' . $columnMeta[0]["Field"] . ';' . $this->_LF;
      $output .= $this->_TAB2 . "}" . $this->_CRLF;
      fwrite($this->writer, $output);
    }
  }

}
