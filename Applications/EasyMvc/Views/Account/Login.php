<?php
use Library\Exceptions\InvalidViewModelTypeException;
use Applications\EasyMvc\Resources\Controller\AccountResx;
$ViewModel = new \Applications\EasyMvc\ViewModels\Account\LoginVm($this->app);
if (!($Vm instanceof Applications\EasyMvc\ViewModels\Account\LoginVm)) {
  throw new InvalidViewModelTypeException();
} else {
  $ViewModel = clone $Vm;
}
$logGuid = \Library\Utility\TimeLogger::StartLog($this->app(), __FILE__);
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
?>
<section id="top_header">
  <section id="branding">
    <figure class="logo"><img src="<?php echo $this->app()->relative_path . $this->app()->logoImageUrl; ?>"></figure>
  </section>
</section>
<section  class="login-container">
  <figure class="login-box">
    <h1><?php echo $ViewModel->ResxFor(AccountResx::h1_title); ?></h1>
    <div class="login-form login-box-small">
      <p style="display: none;">
        <label><?php echo $ViewModel->ResxFor(AccountResx::email_label); ?></label>
        <input 
          autocomplete="on" 
          name="f_user_email" 
          type="text" 
          class="field" 
          data-input-label="<?php echo $ViewModel->ResxFor(AccountResx::email_label); ?>" 
          placeholder="<?php echo $ViewModel->ResxFor(AccountResx::email_ph_text); ?>">
      </p>
      <label><?php echo $ViewModel->ResxFor(AccountResx::username_label); ?></label>
      <input 
        autocomplete="on" 
        name="f_user_login" 
        type="text" 
        class="field" 
        data-input-label="<?php echo $ViewModel->ResxFor(AccountResx::username_label); ?>" 
        placeholder="<?php echo $ViewModel->ResxFor(AccountResx::username_ph_text); ?>">
      </p>
      <label><?php echo $ViewModel->ResxFor(AccountResx::pwd_label); ?></label>
      <input 
        autocomplete="on" 
        name="f_user_password" 
        type="password" 
        class="field" 
        data-input-label="<?php echo $ViewModel->ResxFor(AccountResx::pwd_label); ?>" 
        placeholder="<?php echo $ViewModel->ResxFor(AccountResx::pwd_ph_text); ?>">
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
<?php
\Library\Utility\TimeLogger::EndLog($this->app(), $logGuid);
?>
