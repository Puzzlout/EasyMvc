<?php
/**
 * Lists the constants for framework viewnames to use for autocompletion and easy coding.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc/blob/master/README.md
 * @since Version 1.0.2.1
 * @package FrameworkViewnames
 */

namespace Library\Generated;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class FrameworkViewnames {
  const ConfigFolderKey = 'ConfigFolderKey';  const configRouting = 'configRouting';  const ErrorFolderKey = 'ErrorFolderKey';  const Http404 = 'Http404';  const GeneratorFolderKey = 'GeneratorFolderKey';  const BuildControllerConstantsClass = 'BuildControllerConstantsClass';  const BuildDalModuleConstantsClass = 'BuildDalModuleConstantsClass';  const BuildDao = 'BuildDao';  const BuildResources = 'BuildResources';  const BuildViewnameConstantsClass = 'BuildViewnameConstantsClass';  const Index = 'Index';  const ModulesFolderKey = 'ModulesFolderKey';  const DisplayGeneratedFiles = 'DisplayGeneratedFiles';  const SharedFolderKey = 'SharedFolderKey';  const Layout = 'Layout';  const WebIdeFolderKey = 'WebIdeFolderKey';  const CreateFile = 'CreateFile';  const ClassMethodsForm = 'ClassMethodsForm';  const ClassPropertiesForm = 'ClassPropertiesForm';  const MethodParameters = 'MethodParameters';  public static function GetList() {    return array(      self::ConfigFolderKey => array(        self::configRouting => 'configRouting',      ),      self::ErrorFolderKey => array(        self::Http404 => 'Http404',      ),      self::GeneratorFolderKey => array(        self::BuildControllerConstantsClass => 'BuildControllerConstantsClass',        self::BuildDalModuleConstantsClass => 'BuildDalModuleConstantsClass',        self::BuildDao => 'BuildDao',        self::BuildResources => 'BuildResources',        self::BuildViewnameConstantsClass => 'BuildViewnameConstantsClass',        self::Index => 'Index',        self::ModulesFolderKey => array(        self::DisplayGeneratedFiles => 'DisplayGeneratedFiles',      ),      ),      self::SharedFolderKey => array(        self::Layout => 'Layout',      ),      self::WebIdeFolderKey => array(        self::CreateFile => 'CreateFile',        self::Index => 'Index',        self::ModulesFolderKey => array(        self::ClassMethodsForm => 'ClassMethodsForm',        self::ClassPropertiesForm => 'ClassPropertiesForm',        self::MethodParameters => 'MethodParameters',      ),      ),    );  }}