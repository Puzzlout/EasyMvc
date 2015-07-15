<?php
/**
 * Autoload defines global variables.
 */
define('__ROOT__', dirname(dirname(__FILE__)) . '/');
define("__APPNAME__", "Test");
define("__TESTED_APPNAME__", "EasyMvc");
define("__EXECUTION_ACCESS_RESTRICTION__", TRUE);
require '../Library/autoload.php';

$dalTests = new \Tests\MasterClasses\DalTests();
$dalTests->RunTests();
?>
<html>
  <head>
    <title>Tests page</title>
    <style>
      li {
        margin-bottom: 1px;
      }
      .success {
        background-color: #5bb75b;
      }
      .fail {
        background-color: #dd514c;
        color: #FFF;
        padding: 5px;
      }
      p.result-title {
        font-weight: bolder;
      }
      p.result-description {
        display: none;
      }
    </style>
  </head>
  <body>
    <h1>Results of test below</h1>
    <ul>
      <?php
      foreach ($dalTests->testResults() as $testResult) {
        echo "<li class=\"" . $testResult->resultStatus() . "\">";
        echo "<p class=\"result-title\">" . $testResult->resultTitle() . "</p>";
        echo "<p class=\"result-description\">" . $testResult->resultMessage() . "</p>";
        echo "</li>";
      }
      ?>
    </ul>
</html>
