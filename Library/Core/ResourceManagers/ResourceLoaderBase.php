<?php

/**
 * Provides a set of functions loading the resources from xml files into an array structure. 
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/
 * @since Version 1.0.0
 * @package ResourceLoaderBase
 */

namespace Library\Core\ResourceManagers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ResourceLoaderBase {

  const FROM_XML = 'FROM_XML';
  const FROM_DB = 'FROM_DB';
  
  protected $resoures_path = "";
  protected $res_common = array();
  protected $res_local = array();
  private $_files_common = null;
  private $_files_local = null;
  private $CurrentSubFolder = "";

  public function LoadResources($sourceToLoad);

  private function storeContentsIntoArray($data, $params) {
    //TODO: escape < and > as they are forbidden character in the resource files.
    switch ($params["type"]) {
      case "common":
        foreach ($data as $element) {
          $this->res_common[$params["locale"]][$params["source"]][$element->getAttribute("key")] = $element->nodeValue;
        }
        if (!array_key_exists($params["source"], $this->res_common[$params["locale"]]))
          $this->res_common[$params["locale"]][$params["source"]] = array();
        break;
      case "local":
        foreach ($data as $element) {
          $this->res_local[$params["locale"]][$params["source"]][$element->getAttribute("key")] = $element->nodeValue;
        }
        break;
      default:
        throw new \Exception("Type is incorrect!!! common and local are the only values allowed", NULL, NULL);
    }
  }

}
