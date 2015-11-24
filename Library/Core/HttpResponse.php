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

  public function send(\Library\ViewModels\BaseVm $vm) {
    if (!$this->app()->httpRequest()->IsPost()) {
      $this->page->addVar(\Applications\EasyMvc\Resources\Enums\ViewVariablesKeys::Vm, $vm);
      return $this->page->GetOutput();
    }

    if (!($vm instanceof \Library\ViewModels\BaseJsonVm)) {
      throw new \InvalidArgumentException('$vm must be a valid \Library\ViewModels\BaseJsonVm object. See above dump.'. var_dump($vm), 0, NULL);
    }
    
    $VmJson = new \Library\ViewModels\BaseJsonVm($this->app());
    $VmJson = clone $vm;
    self::SetJsonResponseHeader();
    return $VmJson->Response();
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
   * Set content type to JSON when replying to AJAX call.
   */
  public static function SetJsonResponseHeader() {
    header('Content-Type: application/json');
  }

}
