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
 * SessionKeys Class
 * 
 * All the Session Keys that can be used generically, independantly of the application
 *
 * @package		Library
 * @category	Enums
 * @category	SessionKeys
 * @author		Jeremie Litzler
 * @link		
 */

namespace Library\Enums;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

/**
 * Lists all the SessionKeys used throughout the applications so that we don't use hard-coded strings.
 */
abstract class SessionKeys {

  const UserAuthenticated = "user_auth";
  const UserFlash = 'user_flash';
  const UserConnected = "user_connected";
  const UserRoutes = "user_routes";
  const UserRole = "user_role";
  const UserType = "user_type";
  const UserTypeId = "user_type_id";
  //Routing
  const AllApplicationsRoutes = "app_routes";
  const SessionRoutesXmlLastModified = "app_routes_last_modified";
  const XmlFilesLoaded = "XmlFilesLoaded";
  //Tabs
  const TabsStatus = "tabs_status";

}
