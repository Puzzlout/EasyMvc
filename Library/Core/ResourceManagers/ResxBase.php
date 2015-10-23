<?php

/**
 * Base class for handling the resources
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ResxBase
 */

namespace Library\Core\ResourceManagers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

abstract class ResxBase {

  const GroupKey = "GroupKey";
  const ModuleKey = "ModuleKey";
  const ActionKey = "ActionKey";

  /**
   * Defines if the resources is a common resource or not. By default, it is true.
   * It becomes FALSE when the GroupValue is not specified.
   * @var bool
   */
  public $IsCommon = TRUE;

  /**
   * The key of the common resource group
   * @var string
   */
  public $GroupValue;

  /**
   * The key of the controller resource module
   * @var string 
   */
  public $ModuleValue;

  /**
   * The key of the controller resource action
   * @var string 
   */
  public $ActionValue;

  /**
   * 
   * @param associative array $params
   */
  public function __construct($params) {
    if (is_array($params) && array_key_exists(self::GroupKey, $params)) {
      $this->GroupValue = $params[self::GroupKey];
    } elseif (is_array($params) && (array_key_exists(self::ModuleKey, $params) && array_key_exists(self::ActionKey, $params))) {
      $this->ModuleValue = $params[self::ModuleKey];
      $this->ActionValue = $params[self::ActionKey];
      $this->IsCommon = FALSE;
    } else {
      throw new Exception("You must specify either the group or the module/action.", 0, NULL); //todo: create error code
    }
  }

  /**
   * Method that retrieve the array of resources.
   */
  abstract function GetList();

  /**
   * Get the resource by group and key. See implementation the derived classes.
   * 
   * @param object $resxObj the instance of a derived class from ResxBase
   * that hold the group key to search of the array of resource. See the derived 
   * classes for more details.
   * @param string $key the resource key to find
   */
  abstract public static function GetResource($resxObj, $key);
}
