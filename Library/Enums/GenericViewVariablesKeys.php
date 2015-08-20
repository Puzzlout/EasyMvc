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
 * GenericViewVariablesKeys Class
 *
 * @package		Library
 * @category	Enums
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class GenericViewVariablesKeys {

  //Generic keys
  const data = "data";
  const data_left = "data_left";
  const data_right = "data_right";
  const module = "module";
  const objects = "objects";
  const objects_list_left = "objects_list_left";
  const objects_list_right = "objects_list_right";
  const categorized_list = "categorized_list";
  const categorized_list_left = "categorized_list_left";
  const categorized_list_right = "categorized_list_right";
  const properties = "properties";
  const properties_right = "properties_right";
  const properties_left = "properties_left";
  const property_key = "prop_";
  const property_id = "prop_id";
  const property_name = "prop_name";
  const property_active = "prop_active";
  //For tooltip
  const tooltip_message = "tooltip_message";
  //Form messages in confirm boxes
  const confirm_message = "confirm_message";
  const tabStatus = "tab";
  const active_list = "active_list_module";
  const inactive_list = "inactive_list_module";
  const popup_msg = "popup_msg_module";
  //Mapping
  const map_module = "map_module";

}
