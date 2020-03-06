<?php
/* Smarty version 3.1.30, created on 2020-01-22 19:13:27
  from "/home/nirk/develope/repair_tracker_v2/templates/login/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e2890c71f2e81_63043921',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cb4f66e06a1e323ebf7f7a930d0b11384979efdf' => 
    array (
      0 => '/home/nirk/develope/repair_tracker_v2/templates/login/login.tpl',
      1 => 1578320628,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e2890c71f2e81_63043921 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
  $(document).ready(() => {
    <?php if (isset($_smarty_tpl->tpl_vars['user']->value)) {?>
      Common.setUser(<?php echo $_smarty_tpl->tpl_vars['user']->value;?>
);
    <?php }?>
    Common.init();
    LoginForm.init();
  });
<?php echo '</script'; ?>
>
<div id='loginWrapper'>
  <div id='loginFormWrapper' class='login-wrapper-element'>
    <form id='loginForm' action='index.php?module=login&action=checkauth' method='post'>
      <h2>Login</h2>
      <hr>
      <div class='standard-form-element'>
        <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
        <label class='form-label' for='userName'>
          Email Address
        </label>
        <input type='text' class='width2' name='loginemail' id='userName' placeholder='Email Address'/>
      </div>
      <div class='standard-form-element'>
        <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
        <label class='form-label' for='password'>
          Password
        </label>
        <input type='password' class='width2' name='loginpassword' id='password' placeholder='Password'/>
      </div>
      <div class='button-wrapper'>
        <button type='button' class='std-button' onclick='LoginForm.processLogin();'>Log In</button>
      </div>
    </form>
  </div>
  <div id='registerFormWrapper' class='login-wrapper-element'>
    <form id='createAccountForm' action='index.php?module=login&action=createaccount' method='post'>
      <h2>Create Account</h2>
      <hr>
      <div class='standard-form-element'>
        <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
        <label class='form-label' for='firstName'>
          First Name
        </label>
        <input type='text' class='width2' name='firstname' id='firstName' placeholder='First Name'/>
      </div>
      <div class='standard-form-element'>
        <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
        <label class='form-label' for='lastName'>
          Last Name
        </label>
        <input type='text' class='width2' name='lastname' id='lastName' placeholder='Last Name'/>
      </div>
      <div class='standard-form-element'>
        <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
        <label class='form-label' for='newUserName'>
          Email Address
        </label>
        <input type='text' class='width2' name='email' id='newUserName' placeholder='Email Address'/>
      </div>
      <div class='standard-form-element'>
        <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
        <label class='form-label' for='newPassword1'>
          Password
        </label>
        <input type='password' class='width2' name='password' id='newPassword1' placeholder='Password'/>
      </div>
      <div class='standard-form-element'>
        <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
        <label class='form-label' for='newPassword2'>
          Repeat Password
        </label>
        <input type='password' class='width2' name='confirmpassword' id='newPassword2' placeholder='Repeat Password'/>
      </div>
      <div class='button-wrapper'>
        <button type='button' class='std-button' onclick='LoginForm.processCreateNewAccount();'>Create Account</button>
      </div>
    </form>
  </div>
</div>
<?php }
}
