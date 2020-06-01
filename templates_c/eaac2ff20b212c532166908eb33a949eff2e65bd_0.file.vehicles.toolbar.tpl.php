<?php
/* Smarty version 3.1.30, created on 2020-06-01 15:27:19
  from "C:\develop\repair_tracker\templates\vehicle\vehicles.toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ed51e5719c450_65902436',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eaac2ff20b212c532166908eb33a949eff2e65bd' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\vehicle\\vehicles.toolbar.tpl',
      1 => 1591025038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:toolbar_parent.tpl' => 1,
  ),
),false)) {
function content_5ed51e5719c450_65902436 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19192195695ed51e57199fa6_24417366', 'leftContent');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:toolbar_parent.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'leftContent'} */
class Block_19192195695ed51e57199fa6_24417366 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <button type='button' class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick="window.history.back();">
    <i class="fas fa-arrow-alt-left fa-fw"></i>
  </button>
  <button type='button' class='toolbar-button standard-tooltip' title='Create a new vehicle' onclick="Vehicles.processAddVehicle();">
    <i class="fas fa-plus fa-fw"></i>
  </button>
  <button type='button' id="archiveVehiclesButton" class='toolbar-button standard-tooltip' title='Show archived vehicles' onclick="Vehicles.toggleArchivedVehicles(this);">
    <i class="fas fa-archive fa-fw"></i>
  </button>
<?php
}
}
/* {/block 'leftContent'} */
}
