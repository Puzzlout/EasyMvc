<?php

/**
 * Provides functions to use for the creation of a file in the web ide.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package CreateFileHelper
 */

namespace Applications\Ide\Helpers;

use Library\BO\NewFileItem;
use Library\BO\JsonResult;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class CreateFileHelper {

  /**
   *
   * @var string The value to find the template to get
   */
  private $templateType;

  public static function Init() {
    $helper = new CreateFileHelper();
    return $helper;
  }

  /**
   * Get the file type in the POST request.
   * 
   * @param array $dataPost The POST data sent by the client.
   * @throws \Exception An exception is thrown when the POST data doesn't contain the key "templateType"
   */
  public function GetFileType($dataPost) {
    $templateTypeKey = "templateType";
    if(!array_key_exists($templateTypeKey, $dataPost)) {
      throw new \Exception("The POST data doesn't contain the value $templateTypeKey. See dump" . var_dump($dataPost), 0, NULL);
    }
    
    $this->templateType = $dataPost[$templateTypeKey];
    return $this;
  }
  
  /**
   * 
   * @return string
   * @throws Exception Thrown if the template doesn't not exists.
   * The class Library\GeneratorEngine\Constants\FileTypes constains the list of
   * file that needs a template. The key is used to build the template file name
   * 
   * Ex: MyKeyTemplate.tt
   * 
   * Please a new template if you add a new key/value pair in this list. The templates 
   * are stored in CodeGenerators/templates.
   * 
   * @throws Exception Thrown if the function file_get_contents returns FALSE.
   */
  public function GetTemplateContents() {
    $templateFileName = 
            FrameworkConstants_RootDir . \Library\Enums\FrameworkFolderName::TEMPLATES_DIR . $this->templateType . "Template.tt";
    if(!file_exists($templateFileName)) {
      throw new Exception("The template $templateFileName was not found. Please the template type" . $this->templateType . " or add a new template.", 0, NULL);
    }
    $contents = file_get_contents($templateFileName);
    if(!$contents) {
      throw new Exception("Failed to get contents from $templateFileName", 0, NULL);
    }
    return $contents;
  }
  
  public function SaveFile(\Library\Controllers\BaseController $controller) {
    $result = JsonResult::Init()->SetDefault();
    if(count($controller->dataPost()) === 0) {
      throw new Exception("dataPost is empty! Please the form submission", 0, NULL);
    }
    $newFile = NewFileItem::Init()->Fill($controller->dataPost());
    
    $result->UpdateResult(JsonResult::STATE_SUCCESS, $newFile);
    return $result;
  }
}
