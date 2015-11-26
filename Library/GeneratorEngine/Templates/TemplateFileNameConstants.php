<?php

/**
 * Static class to get the file name of a template.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package TemplateFileNameConstants
 */

namespace Library\GeneratorEngine\Templates;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class TemplateFileNameConstants {
  const RootLocation = "CodeGenerators/templates/";
  const TemplateExtension = ".tt";
  const ClassHeaderTemplate = "ClassHeaderTemplate";
  const ViewTemplate = "ViewTemplate";
  
  public static function GetFullNameForConst($constant)
  {
    $path = FrameworkConstants_RootDir . self::RootLocation . $constant . self::TemplateExtension;
    return $path;
  }
}
