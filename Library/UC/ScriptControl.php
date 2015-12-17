<?php

/**
 * Class to build script tag elements.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ScriptControl
 */

namespace Library\UC;
use \Library\Enums\HtmlAttributes\HtmlAttributeConstants;
use Library\Helpers\HtmlControlBuildHelper;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ScriptControl extends HtmlControlBase implements \Library\Interfaces\IHtmlControlUrlBuilder{

  public function __construct() {
    $this->Attributes = array();
    $this->HtmlOutput = "";
  }
  
  public static function Init() {
    $control = new ScriptControl();
    return $control;
  }
  
  /**
   * 
   * @see \Library\Interfaces\IHtmlControlUrlBuilder
   * @return string
   */
  public function ForInternalResource($jsFilePath) {
    $href = FrameworkConstants_BaseUrl . $jsFilePath;
    $this->GenerateOutput($href);
    return $this->HtmlOutput;
  }
  
  /**
   * 
   * @see \Library\Interfaces\IHtmlControlUrlBuilder
   * @return string
   */
  public function ForExternalResource($jsFileUrl) {
    $this->GenerateOutput($jsFileUrl);
    return $this->HtmlOutput;
  }
  
  /**
   * Generates a script html tag to include a script in the DOM
   * @param string $source The source to load as a script.
   */
  private function GenerateOutput($source) {
    array_push($this->Attributes, HtmlAttribute::Instanciate(HtmlAttributeConstants::Src, $source));
    $this->HtmlOutput = '<script type="application/javascript" {0}></script>';
    HtmlControlBuildHelper::Init()->GenerateAttributes($this);
  }
}
