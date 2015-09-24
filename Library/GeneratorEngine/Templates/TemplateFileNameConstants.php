<?php

/**
 * Static class to get the file name of a template.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package TemplateFileNameConstants
 */

namespace Library\GeneratorEngine\Templates;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class TemplateFileNameConstants {
  const RootLocation = "CodeGenerators/templates";
  const TemplateExtension = ".tt";
  const ClassHeaderTemplate = "ClassHeaderTemplate";
  
  public static function GetFullNameForConst($constant)
  {
    return self::RootLocation . $constant . self::TemplateExtension;
  }
}
