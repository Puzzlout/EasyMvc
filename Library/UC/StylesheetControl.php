<?php

/**
 * Class to build stylesheet link elements.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package StylesheetControl
 */

namespace Library\UC;
use \Library\Enums\HtmlAttributes\HtmlAttributeConstants;
use Library\Helpers\HtmlControlBuildHelper;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class StylesheetControl extends HtmlControlBase implements \Library\Interfaces\IHtmlControlUrlBuilder{

  public function __construct() {
    $this->Attributes = array();
    $this->HtmlOutput = "";
  }
  
  public static function Init() {
    $control = new StylesheetControl();
    return $control;
  }
  
  public function ForInternalResource($cssFilePath) {
    $href = FrameworkConstants_BaseUrl . $cssFilePath;
    $this->GenerateOutput($href);
    return $this->HtmlOutput;
  }
  
  public function ForExternalResource($cssFileUrl) {
    $this->GenerateOutput($cssFileUrl);
    return $this->HtmlOutput;
  }
  
  private function GenerateOutput($href) {
    array_push($this->Attributes, HtmlAttribute::Instanciate(HtmlAttributeConstants::Href, $href));
    $this->HtmlOutput = '<link rel="stylesheet" type="text/css" {0} />';
    HtmlControlBuildHelper::Init()->GenerateAttributes($this);
  }
}
