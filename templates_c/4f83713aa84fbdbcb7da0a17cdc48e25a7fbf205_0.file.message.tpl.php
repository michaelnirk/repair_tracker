<?php
/* Smarty version 3.1.30, created on 2020-03-29 11:08:33
  from "C:\develop\repair_tracker\templates\message.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e8081b1a3df73_92993693',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f83713aa84fbdbcb7da0a17cdc48e25a7fbf205' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\message.tpl',
      1 => 1585477771,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e8081b1a3df73_92993693 (Smarty_Internal_Template $_smarty_tpl) {
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
