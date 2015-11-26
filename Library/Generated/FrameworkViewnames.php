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
  const ConfigFolder = 'ConfigFolder';  const configRouting = 'configRouting';  const ErrorFolder = 'ErrorFolder';  const Http404 = 'Http404';  const GeneratorFolder = 'GeneratorFolder';  const BuildControllerConstantsClass = 'BuildControllerConstantsClass';  const BuildDalModuleConstantsClass = 'BuildDalModuleConstantsClass';  const BuildDao = 'BuildDao';  const BuildResources = 'BuildResources';  const BuildViewnameConstantsClass = 'BuildViewnameConstantsClass';  const Index = 'Index';  const ModulesFolder = 'ModulesFolder';  const DisplayGeneratedFiles = 'DisplayGeneratedFiles';  const SharedFolder = 'SharedFolder';  const Layout = 'Layout';  const WebIdeFolder = 'WebIdeFolder';  const CreateFile = 'CreateFile';  const ClassDerivationInput = 'ClassDerivationInput';  const ClassImplementationInput = 'ClassImplementationInput';  const ClassMethodsForm = 'ClassMethodsForm';  const ClassPropertiesForm = 'ClassPropertiesForm';  const FileDescriptionInput = 'FileDescriptionInput';  const FileDestinationPathInput = 'FileDestinationPathInput';  const FileNameInput = 'FileNameInput';  const FileTypeInput = 'FileTypeInput';  const MethodParameters = 'MethodParameters';  public static function GetList() {    return array(      self::ConfigFolder => array(        self::configRouting => 'configRouting',      ),      self::ErrorFolder => array(        self::Http404 => 'Http404',      ),      self::GeneratorFolder => array(        self::BuildControllerConstantsClass => 'BuildControllerConstantsClass',        self::BuildDalModuleConstantsClass => 'BuildDalModuleConstantsClass',        self::BuildDao => 'BuildDao',        self::BuildResources => 'BuildResources',        self::BuildViewnameConstantsClass => 'BuildViewnameConstantsClass',        self::Index => 'Index',        self::ModulesFolder => array(        self::DisplayGeneratedFiles => 'DisplayGeneratedFiles',      ),      ),      self::SharedFolder => array(        self::Layout => 'Layout',      ),      self::WebIdeFolder => array(        self::CreateFile => 'CreateFile',        self::Index => 'Index',        self::ModulesFolder => array(        self::ClassDerivationInput => 'ClassDerivationInput',        self::ClassImplementationInput => 'ClassImplementationInput',        self::ClassMethodsForm => 'ClassMethodsForm',        self::ClassPropertiesForm => 'ClassPropertiesForm',        self::FileDescriptionInput => 'FileDescriptionInput',        self::FileDestinationPathInput => 'FileDestinationPathInput',        self::FileNameInput => 'FileNameInput',        self::FileTypeInput => 'FileTypeInput',        self::MethodParameters => 'MethodParameters',      ),      ),    );  }}