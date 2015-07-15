<?php
namespace Library\Enums;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

/**
 * List of cache keys.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package CacheKeys
 */
abstract class CacheKeys {
  /**
   * Stores the routes.
   */
  const AllApplicationsRoutes = "app_routes";
  /**
   * Stores the last modification time of the routes.xml
   */
  const SessionRoutesXmlLastModified = "app_routes_last_modified";
  /**
   * Stores the xml reader instances of each xml file.
   */
  const XmlFilesLoaded = "XmlFilesLoaded";
}