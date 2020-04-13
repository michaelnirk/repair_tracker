<?php
/* Smarty version 3.1.30, created on 2020-03-29 14:49:14
  from "C:\develop\repair_tracker\templates\vehicle\vehicles.toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e80b56ae18b53_43055347',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eaac2ff20b212c532166908eb33a949eff2e65bd' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\vehicle\\vehicles.toolbar.tpl',
      1 => 1585493350,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:toolbar_parent.tpl' => 1,
  ),
),false)) {
function content_5e80b56ae18b53_43055347 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4057207955e80b56ae17627_31929604', 'leftContent');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:toolbar_parent.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'leftContent'} */
class Block_4057207955e80b56ae17627_31929604 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <button type='button' class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick="window.history.back();">
    <i class="fas fa-arrow-alt-left fa-fw"></i>
  </button>
  <button type='button' class='toolbar-button standard-tooltip' title='Create a new vehicle' onclick="Vehicles.processAddVehicle();">
    <i class="fas fa-plus fa-fw"></i>
  </button>
<?php
}
}
/* {/block 'leftContent'} */
}
