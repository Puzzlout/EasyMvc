<?php
use Applications\EasyMvc\Resources\Controller\AccountResx;
$ViewModel = new \Applications\EasyMvc\ViewModels\Account\LoginVm($this->app);
if (!($Vm instanceof Applications\EasyMvc\ViewModels\Account\LoginVm)) {
  throw new Library\Exceptions\InvalidViewModelTypeException();
} else {
  $ViewModel = clone $Vm;
}
if (!FrameworkConstants_ExecutionAccessRestriction) {
  exit('No direct script access allowed');
}
?>
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
<p>
  <label><?php echo $ViewModel->ResxFor(AccountResx::username_label); ?></label>
  <input 
    autocomplete="on" 
    name="f_user_login" 
    type="text" 
    class="field" 
    data-input-label="<?php echo $ViewModel->ResxFor(AccountResx::username_label); ?>" 
    placeholder="<?php echo $ViewModel->ResxFor(AccountResx::username_ph_text); ?>">
</p>
<p>
  <label><?php echo $ViewModel->ResxFor(AccountResx::pwd_label); ?></label>
  <input 
    autocomplete="on" 
    name="f_user_password" 
    type="password" 
    class="field" 
    data-input-label="<?php echo $ViewModel->ResxFor(AccountResx::pwd_label); ?>" 
    placeholder="<?php echo $ViewModel->ResxFor(AccountResx::pwd_ph_text); ?>">
</p>
<p>
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
    value="<?php echo $ViewModel->ResxFor("login_btn_text"); ?>" />
</p>
</div> 
