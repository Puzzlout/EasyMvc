<?php
/**
 * Class to retrieve config values.
 * 
 * @author Jeremie Litzler
 * @copyright Copyright (c) 2015
 * @licence http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link https://github.com/WebDevJL/EasyMvc
 * @since Version 1.0.0
 * @package ConfigController
 */

namespace Library\Controllers;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class ConfigController extends \Library\Controllers\BaseController {

  public function GetSettingValue() {
    $result = $this->InitResponseWS(
            array("directory" => "common", "resx_file" => "ws_defaults", "resx_key" => "", "step" => "error")
    );
    $result = \Library\Helpers\ConfigHelper::GetValue($this, $rq, $result);

    if ($result["method"] === \Library\Enums\GenericAppKeys::GET_METHOD) {
      echo '<pre>', print_r($result), '</pre>';
    } else {
      $this->SendResponseWS(
              $result, array(
          "directory" => "common",
          "resx_file" => \Library\Enums\ResourceKeys\ResxFileNameKeys::Config,
          "resx_key" => $this->action(),
          "step" =>
          $result[$rq->getData("key")] !== NULL || $result[$rq->getData("key")] !== "" > 0 ?
                  "success" : "error"
              )
      );
    }
  }
  
  public function ConfigureRouting() {
    $this->app()->dal()->getDalInstance()->GetRoutesDetails();
  }

}
