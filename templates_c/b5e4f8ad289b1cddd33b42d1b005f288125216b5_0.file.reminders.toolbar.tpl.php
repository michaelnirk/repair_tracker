<?php
/* Smarty version 3.1.30, created on 2020-04-11 13:50:31
  from "C:\develop\repair_tracker\templates\reminder\reminders.toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e91cb27db4432_52563013',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b5e4f8ad289b1cddd33b42d1b005f288125216b5' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\reminder\\reminders.toolbar.tpl',
      1 => 1586613028,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:toolbar_parent.tpl' => 1,
  ),
),false)) {
function content_5e91cb27db4432_52563013 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15531346685e91cb27db32b0_01622152', 'leftContent');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:toolbar_parent.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'leftContent'} */
class Block_15531346685e91cb27db32b0_01622152 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <button type="button" class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick='window.history.back();'>
    <i class="fas fa-arrow-alt-left fa-fw"></i>
  </button>
  <button type="button" id='createReminderButton' class='toolbar-button standard-tooltip' title="Create a new reminder" onclick="Reminders.processAddReminder();">
    <i class="fas fa-plus fa-fw"></i>
  </button>
<?php
}
}
/* {/block 'leftContent'} */
}
