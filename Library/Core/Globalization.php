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

  public $GlobalResources = array();
  public $LocalResources = array();

  public function __construct(Application $app) {
    parent::__construct($app);
    $this->Init(ResourceManagers\ResourceLoaderBase::FROM_DB);
  }

  public function Init($source) {
    $dal = $this->app()->dal()->getDalInstance();
    switch ($source) {
      case ResourceManagers\ResourceLoaderBase::FROM_DB:
        $objectLists = array();
        $objectLists[self::COMMON_RESX_OBJ_LIST] = $dal->selectMany(new \Library\BO\F_common_resource(), new \Library\Dal\DbQueryFilters());
        $objectLists[self::CONTROLLER_RESX_OBJ_LIST] = $dal->selectMany(new \Library\BO\F_controller_resource(), new \Library\Dal\DbQueryFilters());
        $this->OrganizeResourcesIntoAssociativeArray($objectLists);
        break;

      default:
        //todo: create error code
        throw new \Exception("Source " . $source . " is not implemented", 0, NULL);
    }
  }

  /**
   * $this->GlobalResources and $this->LocalResources hold a array of F_resource_global
   * and F_resource_local objects.
   * 
   * We could use these list and use a loop to find the resource by key and culture.
   * Instead, let's transform the array into an associative array of this form:
   * 
   * //For Global Resources
   * $array = array(
   *    "en" => array(
   *      "key1" => "value1",
   *      "key2" => "value2",
   *      ...
   *      "keyN" => "valueN",
   *    ),
   *    "fr" => array(
   *      "key1" => "value1",
   *      "key2" => "value2",
   *      ...
   *      "keyN" => "valueN",
   *    )
   * );
   * 
   * //For Local Resources
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
   */
  private function OrganizeResourcesIntoAssociativeArray($objectLists) {
    $this->OrganizeCommonResources($objectLists[self::COMMON_RESX_OBJ_LIST]);
    $this->OrganizeControllerResources($objectLists[self::CONTROLLER_RESX_OBJ_LIST]);
  }

  private function OrganizeCommonResources($resources) {
    $assocArray = array(self::COMMON_RESX_ARRAY_KEY);
    foreach ($resources as $resourceObj) {
      $cleanArray = \Library\Helpers\CommonHelper::CleanPrefixedkeyInAssocArray((array) $resourceObj);
      if (isset($assocArray[self::COMMON_RESX_ARRAY_KEY][$resourceObj->f_culture_id()])) {
        
      } else {
        $assocArray
            [self::COMMON_RESX_ARRAY_KEY]
            [$cleanArray[\Library\BO\F_common_resource::F_CULTURE_ID]] = $cleanArray;
      }
    }
  }

  private function OrganizeControllerResources($param) {
    $assocArray = array();
    foreach ($this->GlobalResources as $key => $value) {
      
    }
  }

  public function getCommonResource($common_source, $key) {
    if ($this->res_common) {
      throw new \Exception("No common resources found.", NULL, NULL);
    }

    if (isset($this->res_common[$this->app->locale][$common_source][$key])) {
      return $this->res_common[$this->app->locale][$common_source][$key];
    } else {
      return $this->res_common['en'][$common_source][$key];
    }

    return null;
  }

  /**
   * Return a resource based on the page name and the key given (/Resources/Local/Page.lang.xml)
   * 
   * @param string $local_source
   * @param string $key
   * @return string
   */
  public function getLocalResource($page_name, $key) {
    if (array_key_exists($this->app->locale, $this->res_local) && array_key_exists($page_name, $this->res_local[$this->app->locale])) {
      return $this->res_local[$this->app->locale][$page_name][$key];
    } else {//always display placeholder for missing locale resource
      return (array_key_exists($page_name, $this->res_local[$this->app->context->defaultLang])) ?
          $this->res_local[$this->app->context->defaultLang][$page_name][$key] :
          'Missing resource: {' . $this->app->locale . '}{' . $page_name . '}{' . $key . '}';
    }

    return null;
  }

  /**
   * Return an array of resources based on the page name given (/Resources/Local/Page.lang.xml)
   * 
   * @param string $page_name
   * @return array
   */
  public function getLocalResourceArray($page_name) {
    if (isset($this->res_local[$this->app->locale][$page_name])) {
      return (array_key_exists($page_name, $this->res_local[$this->app->locale])) ?
          $this->res_local[$this->app->locale][$page_name] :
          $this->getCommonResourceArray($page_name);
    } else {//always display placeholder for missing locale resource
      return (array_key_exists($page_name, $this->res_local[$this->app->context->defaultLang])) ?
          $this->res_local[$this->app->context->defaultLang][$page_name] :
          $this->getCommonResourceArray($page_name);
    }
  }

  /**
   * Return an array of resources based on the page name given (/Resources/Local/Page.lang.xml)
   * 
   * @param string $page_name
   * @return array
   */
  public function getCommonResourceArray($page_name) {
    if (
        array_key_exists($this->app->locale, $this->res_common) &&
        array_key_exists($page_name, $this->res_common[$this->app->locale])) {
      return $this->res_common[$this->app->locale][$page_name];
    } else {//always display placeholder for missing locale resource
      return $this->res_common[$this->app->context->defaultLang][$page_name];
    }
  }

}
