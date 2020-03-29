<?php
/* Smarty version 3.1.30, created on 2020-03-29 14:17:31
  from "C:\develop\repair_tracker\templates\login\login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e80adfb69cee0_37532258',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77512d14365e420a66ad41832db731016452ed01' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\login\\login.tpl',
      1 => 1585491304,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:message.tpl' => 1,
  ),
),false)) {
function content_5e80adfb69cee0_37532258 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>It's Fixed!</title>
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <link rel="stylesheet" type="text/css" href="tooltipster/dist/css/tooltipster.bundle.min.css" />
    <link rel="stylesheet" type="text/css" href="tooltipster/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css" />
    <link href="css/global.css" rel="stylesheet">
    <link href="css/modules/login/login.css" rel="stylesheet">
  </head>
  <body>
    <div class="content">
      <div class='banner'>
        <div class='banner-element left'>
          <a href='index.php?module=vehicle&action=vehicles' id='bannerLink'><i class="fas fa-tools"></i>It's Fixed!</a>
        </div>
      </div>
      <?php $_smarty_tpl->_subTemplateRender("file:message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      
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
    </div>
    <?php echo '<script'; ?>
	src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="tooltipster/dist/js/tooltipster.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src='js/utils.js'><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/modules/login/login.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
              $(document).ready(() => {
                LoginForm.init();
              });
    <?php echo '</script'; ?>
>
  </body>
</html>

<?php }
}
