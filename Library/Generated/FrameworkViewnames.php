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
  const CONFIGFOLDER = 'ConfigFolder';  const CONFIGROUTING = 'configRouting';  const ERRORFOLDER = 'ErrorFolder';  const HTTP404 = 'Http404';  const GENERATORFOLDER = 'GeneratorFolder';  const BUILDCONTROLLERCONSTANTSCLASS = 'BuildControllerConstantsClass';  const BUILDDALMODULECONSTANTSCLASS = 'BuildDalModuleConstantsClass';  const BUILDDAO = 'BuildDao';  const BUILDRESOURCES = 'BuildResources';  const BUILDVIEWNAMECONSTANTSCLASS = 'BuildViewnameConstantsClass';  const INDEX = 'Index';  const MODULESFOLDER = 'ModulesFolder';  const DISPLAYGENERATEDFILES = 'DisplayGeneratedFiles';  const SHAREDFOLDER = 'SharedFolder';  const LAYOUT = 'Layout';  const WEBIDEFOLDER = 'WebIdeFolder';  const CREATEFILE = 'CreateFile';  const CLASSDERIVATIONINPUT = 'ClassDerivationInput';  const CLASSIMPLEMENTATIONINPUT = 'ClassImplementationInput';  const CLASSMETHODSFORM = 'ClassMethodsForm';  const CLASSPROPERTIESFORM = 'ClassPropertiesForm';  const FILECONTENTS = 'FileContents';  const FILEDESCRIPTIONINPUT = 'FileDescriptionInput';  const FILEDESTINATIONPATHINPUT = 'FileDestinationPathInput';  const FILENAMEINPUT = 'FileNameInput';  const FILETYPEINPUT = 'FileTypeInput';  const METHODPARAMETERS = 'MethodParameters';  public static function GetList() {    return array(      self::ConfigFolder => array(        self::CONFIGROUTING => 'configRouting',      ),      self::ErrorFolder => array(        self::HTTP404 => 'Http404',      ),      self::GeneratorFolder => array(        self::BUILDCONTROLLERCONSTANTSCLASS => 'BuildControllerConstantsClass',        self::BUILDDALMODULECONSTANTSCLASS => 'BuildDalModuleConstantsClass',        self::BUILDDAO => 'BuildDao',        self::BUILDRESOURCES => 'BuildResources',        self::BUILDVIEWNAMECONSTANTSCLASS => 'BuildViewnameConstantsClass',        self::INDEX => 'Index',        self::ModulesFolder => array(        self::DISPLAYGENERATEDFILES => 'DisplayGeneratedFiles',      ),      ),      self::SharedFolder => array(        self::LAYOUT => 'Layout',      ),      self::WebIdeFolder => array(        self::CREATEFILE => 'CreateFile',        self::INDEX => 'Index',        self::ModulesFolder => array(        self::CLASSDERIVATIONINPUT => 'ClassDerivationInput',        self::CLASSIMPLEMENTATIONINPUT => 'ClassImplementationInput',        self::CLASSMETHODSFORM => 'ClassMethodsForm',        self::CLASSPROPERTIESFORM => 'ClassPropertiesForm',        self::FILECONTENTS => 'FileContents',        self::FILEDESCRIPTIONINPUT => 'FileDescriptionInput',        self::FILEDESTINATIONPATHINPUT => 'FileDestinationPathInput',        self::FILENAMEINPUT => 'FileNameInput',        self::FILETYPEINPUT => 'FileTypeInput',        self::METHODPARAMETERS => 'MethodParameters',      ),      ),    );  }}