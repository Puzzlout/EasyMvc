<?php

/**
 * Class helper to build HTML code.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package HtmlControlBuildHelper
 */

namespace Library\Helpers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class HtmlControlBuildHelper {

  /**
   * Create an instance of the class.
   * 
   * @return \Library\Helpers\HtmlControlBuildHelper The instance of the class
   */
  public static function Init() {
    $HtmlControllBuildHelper = new HtmlControlBuildHelper();
    return $HtmlControllBuildHelper;
  }

  /**
   * Replace the placeholders in a HTML control with the ordered attributes found
   * in $control->Attributes list. The attribute 0 will replace the placeholder {0} 
   * and so on.
   * @param \Library\UC\HtmlControlBase $control The control to process
   * @throws Exception When a placeholder is not replaced.
   * @throws Exception When a placeholder is not found in $control->HtmlOutput.
   * @todo create error codes for exceptions
   * @todo create custom exception class for exceptions
   */
  public function FillAttributes(\Library\UC\HtmlControlBase $control) {
    foreach ($control->Attributes as $index => $attribute) {
      if (!preg_match('`[\{' . $index . '\}]`', $control->HtmlOutput)) {
        throw new \Exception(
        'The placeholder {' . $index . '} to replace doesn\'t exist. The $control->Attributes[' . $index . '] would be ignored. See dump above.' . var_dump($control), 0, NULL);
      } else {
        $control->HtmlOutput = str_replace('{' . $index . '}', $attribute->Name . '="' . $attribute->Value . '"', $control->HtmlOutput);
      }
    }
    if (preg_match('`\{\w\}`', $control->HtmlOutput)) {
      throw new \Exception(
      "The control HtmlOutput still has placeholders unreplaced. See dump above." . var_dump($control), 0, NULL);
    }
  }

}
