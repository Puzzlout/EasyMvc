<?php

namespace Applications\EasyMvc\Config;

if (!defined('__EXECUTION_ACCESS_RESTRICTION__'))
  exit('No direct script access allowed');

/**
 * Array of values to use in the application.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMVC
 * @since Version 1.0.0
 * @package AppSettings
 */
class AppSettings {
  /**
   * Retrieve the appsettings.
   * 
   * @return associative array : key/value array.
   * @see \Library\Enums\AppSettingKeys : list of keys used in the array.
   */
  public static function Get() {
    return array(
        \Library\Enums\AppSettingKeys::ApplicationBaseUrl => "/{{app_name}}/",
        \Library\Enums\AppSettingKeys::ApplicationMode => "DEV",
        \Library\Enums\AppSettingKeys::ApplicationsDalFolderPath => "\Applications\{{app_name}}\Models\Dal\\",
        \Library\Enums\AppSettingKeys::DefaultCulture => "en-US",
        \Library\Enums\AppSettingKeys::DefaultEmailDomainValue => "apps-jl.net",
        \Library\Enums\AppSettingKeys::DefaultPage => "login",
        \Library\Enums\AppSettingKeys::EncryptionKey => "4lx81277pVi606I4X77Q258bT7ua1GMZ",
        \Library\Enums\AppSettingKeys::ErrorLoggingMethod => "error-log-type-echo",
        \Library\Enums\AppSettingKeys::GoogleMapsCenterLat => "0.000000",
        \Library\Enums\AppSettingKeys::GoogleMapsCenterLng => "0.000000",
        \Library\Enums\AppSettingKeys::GoogleMapsNoLatLngIcon => "ltblu-blank_maps.png",
        \Library\Enums\AppSettingKeys::LogoImageUrl => "logo.png",
        \Library\Enums\AppSettingKeys::Myslq_host => "localhost",
        \Library\Enums\AppSettingKeys::Mysql_db_name => "easymvc_db",
        \Library\Enums\AppSettingKeys::Mysql_pwd => "3ASY%mvc@2015",
        \Library\Enums\AppSettingKeys::Mysql_user => "easymvc",
        \Library\Enums\AppSettingKeys::PasswordSalt => "g496lJL683yFiDzju2K94f1751Lo7WSw",
        \Library\Enums\AppSettingKeys::RootDocumentUpload => "Web/images/",
        \Library\Enums\AppSettingKeys::RootImageFolderPath => "../ClienSide/uploads/",
        \Library\Enums\AppSettingKeys::UseEmailLinkForFirstLogin => TRUE,
        \Library\Enums\AppSettingKeys::TooltipsXmlFileName => "Applications\{{app_name}}\Resources\Common\\tooltipandpopupstrings.{{culture}}.xml",
    );
  }  
}