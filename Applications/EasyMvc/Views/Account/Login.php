<?php if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
} ?>
<?php 
  $resx = new Library\Core\ResourceManagers\ControllerResxBase(
          array(
              Library\Core\ResourceManagers\ResourceBase::ModuleKey => $CurrentRoute->module(),
               Library\Core\ResourceManagers\ResourceBase::ActionKey => $CurrentRoute->action(),
               Library\Core\ResourceManagers\ResourceBase::CultureKey => $culture));


?>
<section id="top_header">
  <section id="branding">
    <figure class="logo"><img src="<?php echo $this->app()->relative_path . $this->app()->logoImageUrl; ?>"></figure>
<!--    <p class="brand"><?php //echo $resx_menu_left["brand"];   ?></p>-->
  </section>
</section>
<section  class="login-container">
  <figure class="login-box">
    <h1><?php echo $resx->GetResource("h1_title"); ?></h1>
    <div class="login-form login-box-small">
      <p style="display: none;">
        <label><?php echo $resx->GetResource("email_label"); ?></label>
        <input 
          autocomplete="on" 
          name="f_user_email" 
          type="text" 
          class="field" 
          data-input-label="<?php echo $resx->GetResource("email_label"); ?>" 
          placeholder="<?php echo "email_ph_text"; ?>">
      </p>
      <label><?php echo "username_label"; ?></label>
      <input 
        autocomplete="on" 
        name="f_user_login" 
        type="text" 
        class="field" 
        data-input-label="<?php echo "username_label"; ?>" 
        placeholder="<?php echo "username_ph_text"; ?>">
      </p>
      <label><?php echo "pwd_label"; ?></label>
      <input 
        autocomplete="on" 
        name="f_user_password" 
        type="password" 
        class="field" 
        data-input-label="<?php echo "pwd_label"; ?>" 
        placeholder="<?php echo "pwd_ph_text"; ?>">
      </p>
<!--        <input name="remember_me" type="checkbox" value="" />
      <?php echo "remember_me_label"; ?>
        <a href="#" name="forgot_pwd"  class="password">
<?php echo "forgot_pwd_label"; ?>
        </a>-->
      </p>
      <div class="login-btn">
        <input 
          id="btn_login" 
          class="btn btn-primary btn-lg" 
          role="button" 
          type="button" 
          value="<?php echo "login_btn_text"; ?>" />
        </p>
      </div> 
    </div>
  </figure>
</section >

