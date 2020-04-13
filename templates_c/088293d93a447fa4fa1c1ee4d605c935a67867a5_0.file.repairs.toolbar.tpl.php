<?php
/* Smarty version 3.1.30, created on 2020-03-29 14:53:45
  from "C:\develop\repair_tracker\templates\repair\repairs.toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e80b679bdbe27_12214266',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '088293d93a447fa4fa1c1ee4d605c935a67867a5' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\repair\\repairs.toolbar.tpl',
      1 => 1585493619,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:toolbar_parent.tpl' => 1,
  ),
),false)) {
function content_5e80b679bdbe27_12214266 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6577533935e80b679bda430_68122646', 'leftContent');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:toolbar_parent.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'leftContent'} */
class Block_6577533935e80b679bda430_68122646 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <button type="button" class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick='window.history.back();'>
    <i class="fas fa-arrow-alt-left fa-fw"></i>
  </button>
  <button type="button" id='createRepairButton' class='toolbar-button standard-tooltip' title="Create a new repair for this vehicle" onclick="Repairs.processAddRepair();">
    <i class="fas fa-plus fa-fw"></i>
  </button>
<?php
}
}
/* {/block 'leftContent'} */
}
