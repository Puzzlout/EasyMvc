<?php
require_once '../errorHandler.php';
require_once 'loader.php';
$generator = new Library\GeneratorEngine\Core\DalModuleNameConstantsEngine("DalModules");
$generator->Run();
?>

<html>
  <head>
    <title>Controller names array generator</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css"/>
  </head>
  <body>
    <div class="top-bar">
      <a href="index.php">Go back</a>
    </div>
    <div class="content">
      <p>Files generated:</p>
      <ul>
        <?php
        foreach ($generator->filesGenerated as $file) {
          echo '<li>' . $file . '</li>';
        }
        ?>
      </ul>
    </div>
  </body>
</html>
