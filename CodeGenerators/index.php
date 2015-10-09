<?php
require_once 'loader.php';

const PlaceholderModule = "{{module}}";
const PlaceholderMessageModule = "{{message_module}}";
$GeneratorFileName = "Generate" . PlaceholderModule . "ConstantsClass.php";
$GeneratorDesc = "Generate " . PlaceholderMessageModule . " constants class";
const Controller = "Controller";
const DalModule = "DalModule";
const ViewName = "ViewName";
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
      <li>
        <a href="<?php echo str_replace(PlaceholderModule, Controller, $GeneratorFileName); ?>">
          <?php echo str_replace(PlaceholderMessageModule, strtolower(Controller), $GeneratorDesc); ?>
        </a>
      </li>
      <li>
        <a href="<?php echo str_replace(PlaceholderModule, DalModule, $GeneratorFileName); ?>">
          <?php echo str_replace(PlaceholderMessageModule, strtolower(DalModule), $GeneratorDesc); ?>
        </a>
      </li>
      <li>
        <a href="<?php echo str_replace(PlaceholderModule, ViewName, $GeneratorFileName); ?>">
          <?php echo str_replace(PlaceholderMessageModule, strtolower(ViewName), $GeneratorDesc); ?>
        </a>
      </li>
    </ul>
  </body>
</html>