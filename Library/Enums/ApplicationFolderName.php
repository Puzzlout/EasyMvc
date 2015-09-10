<?php

/**
 * Constants of Application folder values to help build system paths.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package ApplicationFolderName
 */

namespace Library\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class ApplicationFolderName {

  const AppsFolderName = "Applications/";
  const ControllersFolderName = "/Controllers/";
  const ViewsFolderName = "/Views/";
  const TemplatesFolderName = "/Templates/";
  const ConfigFolderName = "/Config/";
  const ResourceCommonFolderName = "/Resources/Common/";
  const ResourceLocalFolderName = "/Resources/Local/";
  const WebJs = "Web/js/";
  const WebCss = "Web/css/";
  const ModulesFolderName = "/Modules/";
  const Generated = "/Generated/";
}
