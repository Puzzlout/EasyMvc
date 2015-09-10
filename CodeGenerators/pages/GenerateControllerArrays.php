<?php
include_once '../../Library/FrameworkConstants.php';
\Library\FrameworkConstants::SetNamedConstants();
include_once '../../Library/autoload.php';
$generator = new \Library\Controllers\Generator\ControllerNameListExtractor();
$generator->GenerateFiles();
?>

<html>
  <head>
    <title>Controller names array generator</title>
    <style>
      .top-bar, .top-bar > * {
        line-height: 40px;
        background-color: #eee;
      }
    </style>
    
  </head>
  <body>
    <div class="top-bar">
      <a href="../index.php">Go back</a>
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
