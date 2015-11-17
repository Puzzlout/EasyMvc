<?php

/**
 * Base class for generators.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ConstantsClassGeneratorBase
 */

namespace Library\GeneratorEngine\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class ConstantsClassEngineBase {
  /**
   * Holds the static values to build the class, like the namespace, the description, etc.
   * @var array
   */
  public $params = array();
  /**
   *
   * @var string represents the class prefix of the constants list.
   * @example Controllers, DalModules, etc. 
   */
  public $GeneratedClassPrefix = "";

  /**
   *
   * @var array list of filenames generated. 
   */
  public $filesGenerated = array();

  public function __construct($classPrefix) {
    $this->GeneratedClassPrefix = $classPrefix;
  }

  /**
   * Generate the Constant Class list the framework.
   * 
   * @param assoc array $params the params composed the namespace and name of the class.
   * @param array(of String) $files the list of framework files that will make the list of constants
   */
  protected function GenerateConstantsClass($files) {
    if (count($files) > 0) {
      $classGen = new ConstantsClassGenerator($this->params, $files);
      $classGen->BuildClass();
      return str_replace('\\', '/', "file://" . FrameworkConstants_RootDir . $this->params[BaseClassGenerator::NameSpaceKey] . "/" . $classGen->fileName);
    } else {
      return "No class to generate.";
    }
  }

  /**
   * Retrieve the data and then generate the Classes.
   * The implementation is specific to each case. See the derived generator
   * classes.
   * 
   * @param assoc array $data depending on the situation, some data can be passed
   * on to generate the files desired.
   */
  abstract public function Run($data = NULL);

  /**
   * Generate the FrameworkControllers.php class.
   * 
   * @param array $files list of filenames
   */
  protected function GenerateFrameworkFile($files) {
    $filePath = $this->GenerateConstantsClass($files);
    array_push($this->filesGenerated, $filePath);
    return $filePath;
  }

  /**
   * Generate the AppName{$this->GeneratedClassPrefix}.php class.
   * 
   * @param array $files list of filenames
   */
  protected function GenerateApplicationFile($files) {
    $filePath = $this->GenerateConstantsClass($files);
    array_push($this->filesGenerated, $filePath);
    return $filePath;
  }

}
