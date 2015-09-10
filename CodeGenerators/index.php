<?php
require_once 'loader.php';
const PagesFolder = "pages/";
const GenerateControllerArraysFile = "GenerateControllerArrays.php";
?>
<html>
  <head>
    <title>Generators</title>
    <style></style>
  </head>
  <body>
    <h1>Generator scripts</h1>
    <p>On this page, you can generate code by simple click.</p>
    <ul>
      <li><a href="<?php echo PagesFolder . GenerateControllerArraysFile; ?>">Generate controller names arrays</a></li>
    </ul>
  </body>
</html>