<?php if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
} ?>
<section id="top_header">
  <section id="branding">
    <figure class="logo"><img src="<?php echo $this->app()->relative_path . $this->app()->logoImageUrl; ?>"></figure>
<!--    <p class="brand"><?php //echo $resx_menu_left["brand"];   ?></p>-->
  </section>
</section>
<section  class="login-container">
  <figure class="login-box">
    <h1><?php echo $this->app->i8n()->getControllerResx("h1_title"); ?></h1>
    <div class="login-form login-box-small">
      <p style="display: none;">
        <label><?php echo $this->app->i8n()->getControllerResx("email_label"); ?></label>
        <input 
          autocomplete="on" 
          name="f_user_email" 
          type="text" 
          class="field" 
          data-input-label="<?php echo $this->app->i8n()->getControllerResx("email_label"); ?>" 
          placeholder="<?php echo $resx["email_ph_text"]; ?>">
      </p>
      <label><?php echo $resx["username_label"]; ?></label>
      <input 
        autocomplete="on" 
        name="f_user_login" 
        type="text" 
        class="field" 
        data-input-label="<?php echo $resx["username_label"]; ?>" 
        placeholder="<?php echo $resx["username_ph_text"]; ?>">
      </p>
      <label><?php echo $resx["pwd_label"]; ?></label>
      <input 
        autocomplete="on" 
        name="f_user_password" 
        type="password" 
        class="field" 
        data-input-label="<?php echo $resx["pwd_label"]; ?>" 
        placeholder="<?php echo $resx["pwd_ph_text"]; ?>">
      </p>
<!--        <input name="remember_me" type="checkbox" value="" />
      <?php echo $resx["remember_me_label"]; ?>
        <a href="#" name="forgot_pwd"  class="password">
<?php echo $resx["forgot_pwd_label"]; ?>
        </a>-->
      </p>
      <div class="login-btn">
        <input 
          id="btn_login" 
          class="btn btn-primary btn-lg" 
          role="button" 
          type="button" 
          value="<?php echo $resx["login_btn_text"]; ?>" />
        </p>
      </div> 
    </div>
  </figure>
</section >

