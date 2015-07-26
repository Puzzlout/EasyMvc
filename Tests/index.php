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
      * {
        margin: 0;
        padding: 0;
        border: 0;
      }
      li, h2 {
        margin-bottom: 1px;
        color: #FFF;
        padding: 5px 5px;
      }
      .success {
        background-color: #28a247;
      }
      .fail {
        background-color: #e22b2f;
      }
      p.result-title {
        font-weight: bolder;
      }
      p.result-description {
        text-indent: 2em;
      }
    </style>
  </head>
  <body>
    <h1>Results of test below:</h1>
    <h2 class="success">Tests successed: <?php echo ''; ?></h2>
    <h2 class="fail">Tests failed: <?php echo ""; ?></h2>
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
