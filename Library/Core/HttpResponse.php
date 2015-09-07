<?php

namespace Library\Core;

if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}

class HttpResponse extends ApplicationComponent {

  protected $page;

  public function addHeader($header) {
    header($header);
  }

  public function redirect($location) {
    \Library\Utility\TimeLogger::EndLog($this->app(), \Library\Enums\ResourceKeys\GlobalAppKeys::log_http_request);
    header('Location: ' . $location);
    exit;
  }

  public function displayError(\Library\BO\Error $error) {
    $this->page = new Page($this->app);
    $this->page->addVar("error", $error);
    $this->page->setContentFile(FrameworkConstants_RootDir . 'Errors/' . $error->errorId() . '.php');

    //$this->addHeader('HTTP/1.0 404 Not Found');

    $this->send();
  }

  public function send() {
    if (!$this->app->router->isWsCall) {
      //Return the content to page
      exit($this->page->getGeneratedPage());
    } else {
      //Since we are doing a AJAX call, we just exit.
      \Library\Utility\TimeLogger::EndLog($this->app, \Library\Enums\ResourceKeys\GlobalAppKeys::log_http_request);
      die();
    }
    die();
  }

  public function setPage(Page $page) {
    $this->page = $page;
  }

  // Changement par rapport à la fonction setcookie() : le dernier argument est par défaut à true.
  /*
   * Set cookie
   * 
   * params = [
   *    'name' => '',
   *    'value' => '',
   *    'expire' => '',
   *    'path' => '', 
   *    'domain' => '', 
   *    'secure' => '', 
   *    'httpOnly' => ''
   * ]
   */
  public function setCookie($params) {
    setcookie(
            $params['name'], $params['value'], $params['expire'], $params['path'], $params['domain'], $params['secure'], $params['httpOnly']
    );
  }

  /**
   * Set content type to JSON when replying to AJAX call and encode the data sent back.
   * 
   * @param array $response
   * @return json
   */
  public static function encodeJson($response) {
    header('Content-Type: application/json');
    return json_encode($response, 128); //Encode response to pretty JSON
  }

}
