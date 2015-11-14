<?php
use Library\Exceptions\InvalidViewModelTypeException;
use Applications\EasyMvc\Resources\Controller\AccountResx;
$ViewModel = new \Applications\EasyMvc\ViewModels\Account\LoginVm($this->app);
if (!($Vm instanceof Applications\EasyMvc\ViewModels\Account\LoginVm)) {
  throw new InvalidViewModelTypeException();
} else {
  $ViewModel = clone $Vm;
}
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
      <?php require Library\Core\ViewLoader::GetPartialView("Account","LoginForm"); ?>
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
