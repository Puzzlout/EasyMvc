<?php

namespace Library\Interfaces;

interface IViewLoader {
  public static function Init(\Library\Controllers\BaseController $controller);
  public function GetView();
  public function GetPathForView($rootDir);
  public function GetPartialView($viewName);
}
