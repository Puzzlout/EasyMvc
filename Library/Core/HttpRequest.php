<?php

namespace Library\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class HttpRequest {

  public $requestId;

  public function __construct() {
    $this->requestId = \Library\Utility\UUID::v4();
  }

  public function requestId() {
    return $this->requestId;
  }

  public function setRequestId($requestId) {
    $this->requestId = $requestId;
  }

  public function cookieData($key) {
    $isKeyFound = $this->cookieExists($key);
    if (!$isKeyFound) {
      throw \Exception($key . ' is not present in the $_COOKIE', 0, null);
    }

    $result = filter_input(INPUT_COOKIE, $key);
    return $result;
  }

  public function cookieExists($key) {
    $result = filter_input(INPUT_COOKIE, $key);
    if (is_null($result)) {
      return false;
    }

    return isset($result);
  }

  public function getData($key) {
    return $this->getExists($key) ? $_GET[$key] : null;
  }

  public function getExists($key) {
    return isset($_GET[$key]);
  }

  public function method() {
    return $_SERVER['REQUEST_METHOD'];
  }

  public function postData($key) {
    return isset($_POST[$key]) ? $_POST[$key] : null;
  }

  public function postExists($key) {
    return isset($_POST[$key]);
  }

  public function requestURI() {
    $key = 'REQUEST_URI';
    if (!array_key_exists($key, $_SERVER)) {
      throw new Exception($key . ' is not set in $_SERVER. See dump above.' . var_dump($_SERVER), 0, NULL);
    }
    return strtok($_SERVER[$key], '?');
  }

  protected function requestType() {
    $key = 'REQUEST_METHOD';
    if (!array_key_exists($key, $_SERVER)) {
      throw new Exception($key . ' is not set in $_SERVER. See dump above.' . var_dump($_SERVER), 0, NULL);
    }
    return $_SERVER[$key];
  }

  public function IsPost() {
    if ($this->requestType() === "POST") {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function initLanguage(Application $currentApp, $type) {
    if ($type === "default") {
      return $currentApp->config()->get(Enums\AppSettingKeys::DefaultLanguage);
    }
    if ($type === "browser") {
      //Get the first culture
      $culture = substr(strtok($_SERVER['HTTP_ACCEPT_LANGUAGE'], '?'), 0, 5);
      //Check if the first culture is a short or long version, i.e. en ou en-US.
      //If it is the short version, we update the culture to return.
      if (!strpos($culture, "-"))
        $culture = substr($culture, 0, 2);
      return $culture;
    }
  }

  /**
   * Fetch the POST data from the php://input array which is compatible with 
   * modern post requests.
   * We keep the old $_POST source for the time being, even if it will be 
   * depreaced.
   *
   * @access	public
   * @param	bool
   * @return array The POST data (associative array if necessary)
   */
  public function retrievePostAjaxData($xss_clean = TRUE) {
    $postData = $this->ParseDataFromPhpInput();
    if (count($postData) > 0) {
      return $postData;
    }
    $postData = $this->ParseDataFromGlobalVar();
    return $postData;
  }

  /**
   * Retrieve the POST data from php://input
   * @return array The POST data (associative array if necessary)
   */
  private function ParseDataFromPhpInput() {
    if (file_get_contents('php://input') == "") {
      return array();
    }
    $jsonDecodedData = json_decode(file_get_contents('php://input'));
    if (is_null($jsonDecodedData)) {
      return array();
    }
    $postData = get_object_vars($jsonDecodedData);
    if (empty($postData)) {
      return array();
    }
    return $postData;
  }
  
  /**
   * Retrieve the POST data from $_POST super global
   * @return array The POST data (associative array if necessary)
   */
  private function ParseDataFromGlobalVar() {
    $postData = filter_input_array(INPUT_POST);
    $postDataCleaned = $this->FetchData($postData);
    return $postDataCleaned;
  }
  
  private function FetchData($postDataRaw) {
    $postDataCleaned = array();
    foreach (array_keys($postDataRaw) as $key) {
      $postDataCleaned[$key] = $this->ValidateData($postDataRaw, $key, TRUE);
    }
    return $postDataCleaned;
  }

  // --------------------------------------------------------------------

  /**
   * Fetch from array
   *
   * This is a helper function to retrieve values from global arrays
   *
   * @access	private
   * @param	array
   * @param	string
   * @param	bool
   * @return	string
   */
  private function ValidateData(&$array, $index = '', $xss_clean = FALSE) {
    if (!isset($array[$index])) {
      return FALSE;
    }

    if ($xss_clean === TRUE && !($array[$index] instanceof \stdClass)) {
      $array[$index] = strip_tags($array[$index]);
      $array[$index] = filter_var($array[$index]);
//$security = new BL\Security\Security();
      //return $security->xss_clean($array[$index]);
    }

    return $array[$index];
  }

}
