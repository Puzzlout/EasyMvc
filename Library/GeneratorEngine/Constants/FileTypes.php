<?php

/**
 * The file types possible to create in the Web IDE.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package FileTypes
 */

namespace Library\GeneratorEngine\Constants;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class FileTypes {
  public static function RetrieveList() {
    return array(
        "GenericClass" => "Generic class",
        "View" => "View",
        "ViewModel" => "View model",
        "Helper" => "Helper class",
        "Constants" => "Constants list",
        "Css" => "Style sheet",
        "Js" => "JavaScript file"
    );
  }
}
