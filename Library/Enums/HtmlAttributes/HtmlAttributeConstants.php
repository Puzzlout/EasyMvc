<?php

/**
 * Lists all the html attributes.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package HtmlAttributeConstants
 */

namespace Library\Enums\HtmlAttributes;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class HtmlAttributeConstants {
  const DataRootAttr = "data-";
  const Src = "src";
  const Href = "href";
}
