<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->app->locale; ?>">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="apple-touch-fullscreen" content="yes">
    <title><?php echo $Vm->ResxFor("PageTitle"); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/css/app/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/css/core/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/css/addons/toastr.css" />
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/jquery.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/jquery-ui.js"></script>
  </head>
  <body id="home">
    <?php echo $content; ?>
    <!--<script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/parsexml.js"></script>-->
    <!--<script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/bootbox.min.js"></script>-->
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/toastr.js"></script>  
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/services/config.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/services/dataservice.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/services/utils.js"></script>
  </body>
</html>
