<?php

/**
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package DaoClassGenerator
 */

namespace Library\Dal\Generator;
use Library\GeneratorEngine\CodeSnippets;
use Library\GeneratorEngine\Placeholders;

class DaoClassGenerator {

  protected
  /**
   * The class name set from the table name.
   */
          $className,
          /**
           * The directory where the generated classes are written.
           */
          $dir;
  private
  /**
   * The file name of the class to write.
   */
          $fileName,
          /**
           * The handle to write the file.
           */
          $writer,
          /**
           * The carriage return constant.
           */
          $_CRLF = "\n\r",
          /**
           * The break line constant.
           */
          $_LF = "\r",
          /**
           * The equivalent of one tab.
           */
          $_TAB2 = "  ",
          /**
           * The equivalent of 2 tabs.
           */
          $_TAB4 = "    ",
          /**
           * The equivalent of 3 tabs.
           */
          $_TAB6 = "      ",
          /**
           * The equivalent of 4 tabs.
           */
          $_TAB8 = "        ",
          /**
           * The array that holds the key/value pairs used in the generation of 
           * the class.
           */
          $placeholders,
          /**
           * The flag to know if the class is a framework and application class.
           */
          $isFrameworkClass = true,
          /**
           * The base class from which the class extends.
           */
          $baseClass = "\Library\Core\Entity";

  /**
   * Initializes the object:
   *  - sets the directory $dir,
   *  - sets the class name $className,
   *  - sets the file name $fileName,
   *  - sets the placeholder array with:
   *    > the author,
   *    > the copyright,
   *    > the licence,
   *    > the link to the repository,
   *    > the package,
   *    > the subpackage,
   *    > the version,
   *    > the framework namespace where the Dao classes are stored,
   *    > the applications namespace where the Dao classes are stored,
   *    > the class name.
   *  - sets the flag to tell if the class is from the framework.
   * 
   * @param type $params : array of values
   */
  public function __construct($tableName) {
    $this->dir = FrameworkConstants_RootDir . "Library/Dal/Generator/output/";
    $this->className = ucfirst($tableName);
    $this->fileName = $this->className . ".php";
    $this->placeholders = $this->InitPlaceholders();
    $this->isFrameworkClass =
            (preg_match("`" . \Library\Enums\GenericAppKeys::PREFIX_FRAMEWORK_TABLE . ".*$`", $tableName) ?
                    TRUE :
                    FALSE);
  }

  /**
   * Builds the associative array of placeholders.
   * 
   * @return array : the associative array of placeholder key/value pair.
   */
  private function InitPlaceholders() {
    return array(
        Placeholders\PhpDocPlaceholders::AUTHOR => "Jeremie Litzler",
        Placeholders\PhpDocPlaceholders::COPYRIGHT_YEAR => date("Y"),
        Placeholders\PhpDocPlaceholders::LICENCE => "http://opensource.org/licenses/gpl-license.php GNU Public License",
        Placeholders\PhpDocPlaceholders::LINK => "https://github.com/WebDevJL/",
        Placeholders\PhpDocPlaceholders::PACKAGE => $this->className,
        Placeholders\PhpDocPlaceholders::SUBPACKAGE => "",
        Placeholders\PhpDocPlaceholders::VERSION_NUMBER => FrameworkConstants_Version,
        Placeholders\ClassFilePlaceholders::NAMESPACE_FRAMEWORK => "Library\BO",
        Placeholders\ClassFilePlaceholders::NAMESPACE_APP => "\Applications\"" . FrameworkConstants_AppName . "\Models\Dao",
        Placeholders\ClassFilePlaceholders::CLASS_NAME => $this->className
    );
  }

  /**
   * Opens handle to write to target file.
   */
  public function OpenWriter() {
    $filePath = $this->dir . $this->fileName;
    echo $filePath . "<br />";

    $this->writer = fopen($filePath, 'w') or die("can't open file");
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
    fwrite($this->writer, "<?php" . $this->_CRLF);
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
    $output = CodeSnippets\PhpDocSnippets::OPENING . $this->_LF .
            strtr(CodeSnippets\PhpDocSnippets::AUTHOR, $this->placeholders) . $this->_LF .
            strtr(CodeSnippets\PhpDocSnippets::COPYRIGHT, $this->placeholders) . $this->_LF .
            strtr(CodeSnippets\PhpDocSnippets::LICENCE, $this->placeholders) . $this->_LF .
            strtr(CodeSnippets\PhpDocSnippets::LINK, $this->placeholders) . $this->_LF .
            strtr(CodeSnippets\PhpDocSnippets::SINCE, $this->placeholders) . $this->_LF .
            strtr(CodeSnippets\PhpDocSnippets::PACKAGE, $this->placeholders) . $this->_LF .
            CodeSnippets\PhpDocSnippets::CLOSING . $this->_LF;
    fwrite($this->writer, $output);
  }

  /**
   * Writes the line to prevent direct execution of the PHP class.
   */
  public function AddScriptNotAllowedLine() {
    fwrite($this->writer, $this->_LF . "if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); }" . $this->_CRLF);
  }

  /**
   * Writes the start of the class.
   */
  public function ClassStart() {
    $output = $this->_CRLF . "class " . ucfirst($this->className) . " extends " . $this->baseClass . " {" . $this->_LF;
    fwrite($this->writer, $output);
  }

  /**
   * Closes the class.
   */
  public function ClassEnd() {
    fwrite($this->writer, $this->_LF . "}");
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
  public function BuildClassHeader($tableName) {
    $this->OpenWriter();
    $this->AddPhpOpenTag();
    $this->AddNameSpace();
    $this->AddScriptNotAllowedLine();
    $this->AddFileDescription($tableName);
    $this->ClassStart();
  }

  /**
   * Writes the class body from the columns metadata of the table:
   *  - the constants representing the column names, 
   *  - the fields,
   *  - the property setters and
   *  - the property getters.
   * 
   * @param type $tableColumnsMetadata : List of metadata for each column of a
   * table.
   */
  public function BuildClassBody($tableColumnsMetadata) {
    $this->AddConstants($tableColumnsMetadata);
    $this->AddFields($tableColumnsMetadata);
    $this->AddSetters($tableColumnsMetadata);
    $this->AddGetters($tableColumnsMetadata);
  }

  /**
   * Writes the constant representation of the class's field properties.
   * 
   * @param type $columnsMetadata : List of metadata for each column.
   */
  private function AddConstants($columnsMetadata) {
    $output = "";
    foreach ($columnsMetadata as $columnName => $columnMetadata) {
      $output .= $this->_TAB2 . "const " . strtoupper($columnMetadata["Field"]) . " = \"" . $columnMetadata["Field"] . "\";" . $this->_LF;
    }
    $output .= $this->_CRLF;
    fwrite($this->writer, $output);
  }

  /**
   * Writes the field properties from the columns metadata.
   * 
   * @param type $columnsMetadata : List of metadata for each column.
   */
  private function AddFields($columnsMetadata) {
    //Write the protected fields
    $output = $this->_TAB2 . "protected " . $this->_LF;
    $columnCount = 0;
    foreach ($columnsMetadata as $columnName => $columnMetadata) {
      if (count($columnsMetadata) - 1 === $columnCount) {
        $output .= $this->_TAB4 . "$" . $columnMetadata["Field"] . ";" . $this->_CRLF;
      } else {
        $output .= $this->_TAB4 . "$" . $columnMetadata["Field"] . "," . $this->_LF;
      }
      $columnCount += 1;
    }
    fwrite($this->writer, $output);
  }

  /**
   * Writes the setter functions from the columns metadata (including the PhpDoc).
   * 
   * @param type $columnsMetadata : List of metadata for each column.
   */
  private function AddSetters($columnsMetadata) {
    $output = "";
    foreach ($columnsMetadata as $columnName => $columnMetadata) {
      $output .= $this->AddPropertyPhpDoc($columnMetadata);
      $placeholders = array(
          CodeSnippetPlaceholders::PROPERTY_NAME_FIRST_CAP => ucfirst($columnMetadata["Field"]),
          CodeSnippetPlaceholders::PROPERTY_NAME => $columnMetadata["Field"]);
      $output .=
              $this->_TAB2 .
              strtr(CodeSnippets\ClassFileSnippets::SNIPPET_SET_PROPERTY_START, $placeholders) . $this->_LF;
      $output .=
              $this->_TAB6 .
              strtr(CodeSnippets\ClassFileSnippets::SNIPPET_SET_PROPERTY_ASSIGNMENT, $placeholders) .
              $this->_LF;
      $output .= $this->_TAB2 . CodeSnippets\ClassFileSnippets::SNIPPET_CLOSING_CURLY_BRACKET . $this->_CRLF;
    }
    fwrite($this->writer, $output);
  }

  /**
   * Writes the getter functions from the columns metadata (including the PhpDoc).
   * 
   * @param type $columnsMetadata : List of metadata for each column.
   */
  private function AddGetters($columnsMetadata) {
    $output = "";
    foreach ($columnsMetadata as $columnName => $columnMetadata) {
      $output .= $this->AddPropertyPhpDoc($columnMetadata, FALSE);
      $placeholders = array(
          CodeSnippetPlaceholders::PROPERTY_NAME_FIRST_CAP => ucfirst($columnMetadata["Field"]),
          CodeSnippetPlaceholders::PROPERTY_NAME => $columnMetadata["Field"]);

      $output .= $this->_TAB2 .
              strtr(CodeSnippets\ClassFileSnippets::SNIPPET_GET_PROPERTY_START, $placeholders) .
              $this->_LF;
      $output .=
              $this->_TAB4 .
              strtr(CodeSnippets\ClassFileSnippets::SNIPPET_GET_PROPERTY_MIDDLE, $placeholders) .
              $this->_LF;
      $output .= $this->_TAB2 . CodeSnippets\ClassFileSnippets::SNIPPET_CLOSING_CURLY_BRACKET . $this->_CRLF;
    }
    fwrite($this->writer, $output);
  }

  /**
   * Writes the PhpDoc for the setter and getter functions from a column 
   * metadata.
   * 
   * @param type $columnMetadata : Metadata for a column.
   */
  private function AddPropertyPhpDoc($columnMetadata, $isSetter = TRUE) {
    $output =
            $this->_TAB2 . \Library\GeneratorEngine\CodeSnippets\PhpDocSnippets::OPENING .
            $this->_TAB2 . $this->_LF;
    $placeholders = array(
        "{{set_dynamic_code}}" => strtr(CodeSnippets\PhpDocSnippets::SET_PROPERTY_SUMMARY, array(Placeholders\PhpDocPlaceholders::SET_PROPERTY => $columnMetadata["Field"])),
        "{{get_dynamic_code}}" => strtr(CodeSnippets\PhpDocSnippets::GET_PROPERTY_SUMMARY, array(Placeholders\PhpDocPlaceholders::GET_PROPERTY => $columnMetadata["Field"]))
    );
    if ($isSetter) {
      $output .= $this->_TAB2 . strtr("{{set_dynamic_code}}", $placeholders);
    } else {
      $output .= $this->_TAB2 . strtr("{{get_dynamic_code}}", $placeholders);
    }
    $output .= $this->_LF . $this->_TAB2 . CodeSnippets\PhpDocSnippets::CLOSING . $this->_LF;
    return $output;
  }

}
