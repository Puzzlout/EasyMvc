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
 * MapHelper Class
 *
 * @package		Application/PMTool
 * @category	Helpers
 * @category	MapHelper
 * @author		Jeremie Litzler
 * @link		
 */

namespace \Applications\EasyMvc\Helpers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class MapHelper {

  /**
   * Retrieve the lattitude and longitude from the appsettings.xml
   * to build an associative array in the Google Maps API format 
   * 
   * @param object $configManager
   * The object of Library\Config that read the appconfig.xml
   * 
   * @return array  $coordinates
   * The array in Google Maps API format
   * 
   */
  public static function GetCoordinatesToCenterOverARegion($configManager) {
    return array(
        "lat" => $configManager->get(\Library\Enums\AppSettingKeys::GoogleMapsCenterLat),
        "lng" => $configManager->get(\Library\Enums\AppSettingKeys::GoogleMapsCenterLng)
    );
  }

  /**
   * Retrieve the lattitudes and longitudes from a list of objects
   * based the lattitude and longitude property names filter.
   * 
   * Build as an output an associative array in the Google Maps API format
   * 
   * @param array $objects
   * The array of objects of a given type
   * 
   * @param string $latPropName
   * The lattitude property name of a given object type
   * 
   * @param string $lngPropName
   * The longitude property name of a given object type
   * 
   * @return array $coordinates
   * The array in Google Maps API format
   * 
   */
  public static function BuildLatAndLongCoordFromGeoObjects($objects, $latPropName, $lngPropName) {
    $coordinates = array();
    foreach ($objects as $object) {
      if (self::CheckCoordinateValue($object->$latPropName()) && self::CheckCoordinateValue($object->$lngPropName())) {
        $coordinate = array(
            "lat" => $object->$latPropName(),
            "lng" => $object->$lngPropName()
        );
        array_push($coordinates, $coordinate);
      }
    }
    return $coordinates;
  }

  private static function CheckCoordinateValue($value) {
    return $value !== "" && $value !== "0.000000";
  }

}
