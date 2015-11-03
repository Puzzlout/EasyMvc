<?php

/**
 *
 * @package		Easy MVC Framework
 * @author		Jeremie Litzler
 * @copyright	Copyright (c) 2015
 * @license		
 * @link		
 * @since		
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * ViewVariablesKeys Class
 *
 * @package		Applications/PMTool
 * @category	Resources/Enum
 * @category	ViewVariablesKeys
 * @author		Jeremie Litzler
 * @link		
 */

namespace Applications\EasyMvc\Resources\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ViewVariablesKeys {
  const Resx = "Resx";
  const Vm = "Vm";
}
