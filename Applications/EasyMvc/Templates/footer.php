<?php if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
} ?>
</div><!-- END ROW DIV -->
</div><!-- END CONTENT CONTAINER -->
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Web/library/js/core/parsexml.js"></script>
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Web/library/js/core/bootstrap.min.js"></script>
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Web/library/js/core/bootbox.min.js"></script>
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Web/library/js/core/moment.locales.js"></script>  
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Web/library/js/core/dropzone.js"></script>  
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/toastr.js"></script>  
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/jquery.parseParams.js"></script>  
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/jquery.contextMenu.js"></script>  
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/jquery.ui.position.js"></script>  
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/addons/spin.min.js"></script>  
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Web/library/js/services/config.js"></script>
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Web/library/js/services/dataservice.js"></script>
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Web/library/js/services/utils.js"></script>
<script type="application/javascript" src="<?php echo $this->app->relative_path; ?>Applications/<?php echo FrameworkConstants_AppName; ?>/ClientSide/js/app/controllers/tabs.js"></script>
<?php echo $this->app->globalResources["js_files_html"]; ?>
</body>
</html>
