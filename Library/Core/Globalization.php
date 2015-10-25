<?php

/**
 * Retrieve the resources from a specified source.
 * The caller define the source using the constants:
 *  - FROM_XML
 * or
 *  - FROM_DB
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package Globalization
 *
 * What type of resource will we have?
 *  - global resources that are used on every page, e.g. Application name.
 *  - common resources that are used on several pages, e.g. a link text like "Download"
 *  - local resources that are used in a specific page, e.g. title of paragraph, label, text paragraph url of a link
 *
 * Where do we get the resources from?
 * ==> type: common
 *  - one file per language
 *  - location: Applications/YourApp/Resources/Common
 * ==> type: local
 *  - one file per page and per language listing the resources using the valid keys
 *  - location: Applications/YourApp/Resources/Pages
 * 
 * Can the resources contains HTML??
 *  - yes but javascript must be escaped.
 * 
 * How do we load it?
 *  - we need to load everything when the app is started (e.g. in the Application class constructor)
 *  - loop through all the files in location above and store them in associative arrays (1 per type) so that we can find the value using
 *    + the type (local, common)
 *    + the language 
 *    + the page
 *    + the resource key
 *    + the value
 */

namespace Library\Core;

use Library\BO\F_common_resource;
use Library\BO\F_controller_resource;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class Globalization extends ApplicationComponent {

  const COMMON_RESX_OBJ_LIST = "COMMON_RESX_OBJ_LIST";
  const CONTROLLER_RESX_OBJ_LIST = "CONTROLLER_RESX_OBJ_LIST";
  const COMMON_RESX_ARRAY_KEY = "COMMON_RESX_ARRAY_KEY";
  const CONTROLLER_RESX_ARRAY_KEY = "CONTROLLER_RESX_ARRAY_KEY";

  public $CommonResources = array();
  public $ControllerResources = array();

  public function __construct(Application $app) {
    parent::__construct($app);
  }

  public function Init($source = \Library\Core\ResourceManagers\ResourceBase::FROM_DB) {
    $dal = $this->app()->dal()->getDalInstance();
    switch ($source) {
      case ResourceManagers\ResourceBase::FROM_DB:
        $logGuid = \Library\Utility\TimeLogger::StartLogInfo($this->app(), __CLASS__ . __METHOD__);
        $objectLists = array();
        $objectLists[self::COMMON_RESX_OBJ_LIST] = $dal->selectMany(new \Library\BO\F_common_resource(), new \Library\Dal\DbQueryFilters());
        $objectLists[self::CONTROLLER_RESX_OBJ_LIST] = $dal->selectMany(new \Library\BO\F_controller_resource(), new \Library\Dal\DbQueryFilters());
        $this->OrganizeResourcesIntoAssociativeArray($objectLists);
        \Library\Utility\TimeLogger::EndLog($this->app, $logGuid);
        break;

      default:
        //todo: create error code
        throw new \Exception("Source " . $source . " is not implemented", 0, NULL);
    }
  }

  /**
   * $this->CommonResources and $this->ControllerResources hold a array of F_resource_global
   * and F_resource_local objects.
   * 
   * We could use these list and use a loop to find the resource by key and culture.
   * Instead, let's transform the array into an associative array of this form:
   */
  private function OrganizeResourcesIntoAssociativeArray($objectLists) {
    $this->OrganizeCommonResources($objectLists[self::COMMON_RESX_OBJ_LIST]);
    $this->OrganizeControllerResources($objectLists[self::CONTROLLER_RESX_OBJ_LIST]);
  }

  /**
   * Build the associative array for the Common resources.
   * The structure is:
   * 
   * $array = array(
   *    "culture_id_1" => array(
   *      "group1" 
   *        "key1" => "value1",
   *        "key2" => "value2",
   *        ...
   *        "keyN" => "valueN",
   *    ),
   *    "culture_id_2" => array(
   *        "key1" => "value1",
   *        "key2" => "value2",
   *        ...
   *        "keyN" => "valueN",
   *    )
   * );
   * 
   * @param array(of Library\BO\F_common_resource) $resources the objects to loop through
   */
  private function OrganizeCommonResources($resources) {
    $assocArray = array(self::COMMON_RESX_ARRAY_KEY);
    foreach ($resources as $resourceObj) {
      $cleanArray = \Library\Helpers\CommonHelper::CleanPrefixedkeyInAssocArray((array) $resourceObj);
      if (isset($assocArray
              [self::COMMON_RESX_ARRAY_KEY]
              [$cleanArray[F_common_resource::F_COMMON_RESOURCE_GROUP]]
              [$resourceObj->f_culture_id()]
              [$cleanArray[F_common_resource::F_COMMON_RESOURCE_KEY]])) {
        $assocArray
            [self::COMMON_RESX_ARRAY_KEY]
            [$cleanArray[F_common_resource::F_COMMON_RESOURCE_GROUP]]
            [$resourceObj->f_culture_id()]
            [$cleanArray[F_common_resource::F_COMMON_RESOURCE_KEY]] = array(
          $cleanArray[F_common_resource::F_COMMON_RESOURCE_VALUE],
          $cleanArray[F_common_resource::F_COMMON_RESOURCE_COMMENT]
        );
      } else {
        $assocArray
            [self::COMMON_RESX_ARRAY_KEY]
            [$cleanArray[F_common_resource::F_COMMON_RESOURCE_GROUP]]
            [$cleanArray[\Library\BO\F_common_resource::F_CULTURE_ID]]
            [$cleanArray[F_common_resource::F_COMMON_RESOURCE_KEY]] = array(
          \Library\BO\F_common_resource::F_COMMON_RESOURCE_VALUE => $cleanArray[F_common_resource::F_COMMON_RESOURCE_VALUE],
          \Library\BO\F_common_resource::F_COMMON_RESOURCE_COMMENT => $cleanArray[F_common_resource::F_COMMON_RESOURCE_COMMENT]
        );
      }
    }
    $this->CommonResources = $assocArray[self::COMMON_RESX_ARRAY_KEY];
  }

  /**
   * 
   * //For Controller Resources
   *    "en" => array(
   *      "module1" => array(
   *        "common" => array(
   *          "key1" => "value1",
   *          ...
   *          "keyN" => "valueN"
   *        ),
   *        "action1" => array(
   *          "key1" => "value1",
   *          ...
   *          "keyN" => "valueN"
   *        ),
   *        "action2" => array(
   *          "key1" => "value1",
   *          ...
   *          "keyN" => "valueN"
   *        ),
   *      ),
   *      "module2" => array(
   *        "action3" => array(
   *          "key1" => "value1",
   *          ...
   *          "keyN" => "valueN"
   *        ),
   *        "action4" => array(
   *          "key1" => "value1",
   *          ...
   *          "keyN" => "valueN"
   *        ),
   *      ),
   *    ),
   *    ... repeat for other languages ...
   * );
   * 
   * @param array(of Library\BO\F_controller_resource) $resources the objects to loop through
   */
  private function OrganizeControllerResources($resources) {
    $assocArray = array(self::CONTROLLER_RESX_ARRAY_KEY);
    foreach ($resources as $resourceObj) {
      $cleanArray = \Library\Helpers\CommonHelper::CleanPrefixedkeyInAssocArray((array) $resourceObj);
      if (isset($assocArray
              [self::COMMON_RESX_ARRAY_KEY]
              [$cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_MODULE]]
              [$resourceObj->f_culture_id()]
              [$cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_ACTION]]
              [$cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_KEY]])) {
        $assocArray
            [self::CONTROLLER_RESX_ARRAY_KEY]
            [$cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_MODULE]]
            [$resourceObj->f_culture_id()]
            [$cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_ACTION]]
            [$cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_KEY]] = array(
          \Library\BO\F_controller_resource::F_CONTROLLER_RESOURCE_VALUE => $cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_VALUE],
          \Library\BO\F_controller_resource::F_CONTROLLER_RESOURCE_COMMENT => $cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_COMMENT])
        ;
      } else {
        $assocArray
            [self::CONTROLLER_RESX_ARRAY_KEY]
            [$cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_MODULE]]
            [$cleanArray[\Library\BO\F_common_resource::F_CULTURE_ID]]
            [$cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_ACTION]]
            [$cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_KEY]] = array(
          \Library\BO\F_controller_resource::F_CONTROLLER_RESOURCE_VALUE => $cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_VALUE],
          \Library\BO\F_controller_resource::F_CONTROLLER_RESOURCE_COMMENT => $cleanArray[F_controller_resource::F_CONTROLLER_RESOURCE_COMMENT])
        ;
      }
    }
    $this->ControllerResources = $assocArray[self::CONTROLLER_RESX_ARRAY_KEY];
  }

  /**
   * 
   * @param string $key
   * @return string
   */
  public function getCommonResx($key) {
    $resource = $this->CommonResources
        [$this->app->context()->defaultLang[\Library\BO\F_culture::F_CULTURE_ID]]
        [$key]
        [F_common_resource::F_COMMON_RESOURCE_VALUE];
    return $resource;
  }

  /**
   * 
   * @param string $key
   * @return string
   */
  public function getControllerResx($key) {
    $resource = $this->ControllerResources
        [$this->app->context()->defaultLang[\Library\BO\F_culture::F_CULTURE_ID]]
        [$this->app->router()->currentRoute()->module()]
        [$this->app->router()->currentRoute()->action()]
        [$key]
        [F_controller_resource::F_CONTROLLER_RESOURCE_VALUE];
    return $resource;
  }

}
