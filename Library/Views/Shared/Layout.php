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
    <title><?php echo $ControllerVm->ResxFor("PageTitle"); ?></title>
    <?php
    echo Library\UC\StylesheetControl::Init()->ForInternalResource("Applications/" . FrameworkConstants_AppName . "/ClientSide/css/app/reset.css");
    echo Library\UC\StylesheetControl::Init()->ForInternalResource("Web/library/css/core/bootstrap.css");
    echo Library\UC\StylesheetControl::Init()->ForInternalResource("Applications/" . FrameworkConstants_AppName . "/ClientSide/css/addons/toastr.css");
    echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/core/jquery.js");
    echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/core/jquery-ui.js");
    echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/services/config.js");
    echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/services/dataservice.js");
    echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/services/utils.js");
    ?>
  </head>
  <body id="home">
    <?php echo $content; ?>
    <?php
    //echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/core/parsexml.js");
    //echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/core/bootbox.min.js");
    echo Library\UC\ScriptControl::Init()->ForInternalResource("Applications/" . FrameworkConstants_AppName . "/ClientSide/js/addons/toastr.js");
    echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/services/config.js");
    echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/services/dataservice.js");
    echo Library\UC\ScriptControl::Init()->ForInternalResource("Web/library/js/services/utils.js");
    ?>
  </body>
</html>
