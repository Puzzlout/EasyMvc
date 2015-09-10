<?php
include_once '../../Library/FrameworkConstants.php';
\Library\FrameworkConstants::SetNamedConstants();
include_once '../../Library/autoload.php';
$files = \Library\Controllers\Generator\ControllerNameListExtractor::GenerateFiles();
?>

<html>
  <head>
    <title>Controller names array generator</title>
    <style>
      .top-bar, .top-bar > * {
        line-height: 40px;
        background-color: #AAA;
      }
    </style>
    
  </head>
  <body>
    <div class="top-bar">
      <a href="../">Go back</a>
    </div>
    <div class="content">
      <p>Files generated:</p>
      <ul>
        <?php
        foreach ($files as $file) {
          echo '<li>' . $file . '</li>';
        }
        ?>
      </ul>
    </div>
  </body>
</html>
