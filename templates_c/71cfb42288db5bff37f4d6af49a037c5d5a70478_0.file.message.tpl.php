<?php
/* Smarty version 3.1.30, created on 2020-01-21 20:38:23
  from "/home/nirk/develope/repair_tracker_v2/templates/message.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e27532f360f40_46267747',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71cfb42288db5bff37f4d6af49a037c5d5a70478' => 
    array (
      0 => '/home/nirk/develope/repair_tracker_v2/templates/message.tpl',
      1 => 1573404748,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e27532f360f40_46267747 (Smarty_Internal_Template $_smarty_tpl) {
if (count($_smarty_tpl->tpl_vars['messages']->value['errors']) > 0) {?>
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

<?php }
if (count($_smarty_tpl->tpl_vars['messages']->value['success']) > 0) {?>
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

<?php }
if (count($_smarty_tpl->tpl_vars['messages']->value['caution']) > 0) {?>
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

<?php }
}
}
