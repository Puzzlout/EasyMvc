<?php
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->app->locale; ?>">
  <head>
    <meta charset="utf-8" />
    <title><?php echo $Vm->ResxFor("PageTitle"); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/css/app/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/css/core/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/css/addons/toastr.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/css/addons/jquery.contextMenu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/css/core/jquery-ui.css" />
    <?php echo $this->app->globalResources["css_files"]; ?>    
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/jquery.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/jquery-ui.js"></script>
    <?php echo $this->app->globalResources["js_files_head"]; ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body id="home">
    <?php echo $content; ?>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/parsexml.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/bootstrap.min.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/bootbox.min.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/moment.locales.js"></script>  
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/core/dropzone.js"></script>  
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/toastr.js"></script>  
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/jquery.parseParams.js"></script>  
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/jquery.contextMenu.js"></script>  
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/jquery.ui.position.js"></script>  
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/spin.min.js"></script>  
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/services/config.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/services/dataservice.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Web/library/js/services/utils.js"></script>
    <script type="application/javascript" src="<?php echo FrameworkConstants_BaseUrl; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/app/controllers/tabs.js"></script>
    <?php echo $this->app->globalResources["js_files_html"]; ?>
  </body>
</html>
