<?php

/**
 * Manages the placeholders arrays.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package 
 */

namespace Library\GeneratorEngine\Placeholders;

if (!FrameworkConstants_ExecutionAccessRestriction)
  exit('No direct script access allowed');

class PlaceholdersManager {

  public static function InitPlaceholdersForPhpDoc($params) {
    return array(
        PhpDocPlaceholders::AUTHOR => "Jeremie Litzler",
        PhpDocPlaceholders::COPYRIGHT_YEAR => date("Y"),
        PhpDocPlaceholders::LICENCE => "http://opensource.org/licenses/gpl-license.php GNU Public License",
        PhpDocPlaceholders::LINK => "https://github.com/WebDevJL/EasyMvc/blob/master/README.md",
        PhpDocPlaceholders::PACKAGE => $params[\Library\GeneratorEngine\BaseClassGenerator::ClassNameKey],
        PhpDocPlaceholders::SUBPACKAGE => "",
        PhpDocPlaceholders::VERSION_NUMBER => FrameworkConstants_Version,
        ClassFilePlaceholders::NAMESPACE_FRAMEWORK => $params[\Library\GeneratorEngine\BaseClassGenerator::NameSpaceKey],
        ClassFilePlaceholders::NAMESPACE_APP => "",
        ClassFilePlaceholders::NAMESPACE_CLASS => $params[\Library\GeneratorEngine\BaseClassGenerator::NameSpaceKey],
        ClassFilePlaceholders::CLASS_NAME => $params[\Library\GeneratorEngine\BaseClassGenerator::ClassNameKey],
        ClassFilePlaceholders::CLASS_DESCRIPTION => $params[\Library\GeneratorEngine\BaseClassGenerator::ClassDescriptionKey],
    );
  }

}
