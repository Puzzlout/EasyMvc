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
<section id="top_header">
  <section id="branding">
    <figure class="logo"><img src="<?php echo $this->app->relative_path . $this->app->logoImageUrl; ?>"></figure>
  </section>
</section>
<section  class="login-container">
  <figure class="login-box">
    <h1><?php echo $ViewModel->ResxFor(AccountResx::h1_title); ?></h1>
    <div class="login-form login-box-small">
      <?php require Library\Core\ViewLoader::Init($this->app->controller())->GetPartialView(\Applications\EasyMvc\Generated\EasyMvcViewnames::LoginForm); ?>
    </div>
  </figure>
</section >
