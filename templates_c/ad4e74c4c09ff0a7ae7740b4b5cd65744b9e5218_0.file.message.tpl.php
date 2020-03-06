<?php
/* Smarty version 3.1.30, created on 2020-02-29 17:21:53
  from "/var/www/html/repair_tracker_v2/templates/message.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e5a8fa1bb9d73_11402599',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad4e74c4c09ff0a7ae7740b4b5cd65744b9e5218' => 
    array (
      0 => '/var/www/html/repair_tracker_v2/templates/message.tpl',
      1 => 1582992603,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e5a8fa1bb9d73_11402599 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="messages">
  <?php if (count($_smarty_tpl->tpl_vars['messages']->value['errors']) > 0) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value['errors'], 'error');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
?>
        <div class='message error'><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

  <?php }?>
  <?php if (count($_smarty_tpl->tpl_vars['messages']->value['success']) > 0) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value['success'], 'success');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['success']->value) {
?>
        <div class="message success"><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
</div>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

  <?php }?>
  <?php if (count($_smarty_tpl->tpl_vars['messages']->value['caution']) > 0) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value['caution'], 'caution');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['caution']->value) {
?>
        <div class="message caution"><?php echo $_smarty_tpl->tpl_vars['caution']->value;?>
</div>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

  <?php }?>
</div>
<div id="jsMessagesWrapper"></div><?php }
}
