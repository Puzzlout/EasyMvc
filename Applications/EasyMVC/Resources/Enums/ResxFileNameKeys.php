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
 * ResxFileNameKeys Class
 *
 * @package		Applications/PMTool
 * @category	Resources/Enum
 * @category	ResxFileNameKeys
 * @author		Jeremie Litzler
 * @link		
 */

namespace Applications\EasyMvc\Resources\Enums;
if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');

abstract class ResxFileNameKeys {
  /**
   * Local file names
   */
  const Project = "project";
  const Facility = "facility";
  const Client = "client";
  const Location = "location";
  const Technician = "technician";
  const Service = "service";
  const Task = "task";
//  const FieldForm = "field_form";
  const Pm = "pm";
  const Analyte = "analyte";
  const FieldAnalyte = "field_analyte";
  const LabAnalyte = "lab_analyte";
  
  const Map = "map";
}

?>
