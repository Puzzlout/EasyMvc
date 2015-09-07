<?php

/**
 * Finds and load a class from its full name, e.g. namespace + class name.
 * It will check if the file exists in the <i>FrameworkConstants_RootDir</i> directory.
 * 
 * If it does, it will load the class to be used.
 * Otherwise, it will throw an exception.
 * 
 * @param string $className : the full name, e.g. namespace + class name
 */
function autoload($className) {
  $file = FrameworkConstants_RootDir . str_replace('\\', '/', $className) . '.php';
  $calculateExeTime = defined(FrameworkConstants_EnableBenchmark) ? FrameworkConstants_EnableBenchmark : FALSE;
  try {
    $fileExists = file_exists($file);
    if ($fileExists && $calculateExeTime) {
      $start = microtime(TRUE);
      require_once $file;
      $exeTime = (microtime(TRUE) - $start) * 1000;
      echo "loading class : $className : $exeTime ms<br />";
    } elseif ($fileExists) {
      require_once $file;
    } else {
      throw new ErrorException("Class not found => " . $file);
    }
  } catch (Exception $exc) {
    echo ($exc->getMessage() . " ; " . $exc->getTraceAsString());
  }
}

spl_autoload_register('autoload');
