<?php
require_once 'loader.php';
//const PagesFolder = "pages/";
const GenerateControllerArraysFile = "GenerateControllerArrays.php";
const GenerateDalModuleArraysFile = "GenerateDalModuleArrays.php";
?>
<html>
  <head>
    <title>Code Generator Engine</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css"/>
  </head>
  <body>
    <h1>Generator scripts</h1>
    <p>On this page, you can generate code by simple click.</p>
    <ul>
      <li><a href="<?php echo GenerateControllerArraysFile; ?>">Generate controller names array</a></li>
      <li><a href="<?php echo GenerateDalModuleArraysFile; ?>">Generate data access layer modules names array</a></li>
    </ul>
  </body>
</html>