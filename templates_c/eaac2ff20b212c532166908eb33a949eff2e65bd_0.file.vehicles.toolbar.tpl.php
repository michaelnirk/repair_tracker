<?php
/* Smarty version 3.1.30, created on 2020-03-29 11:27:09
  from "C:\develop\repair_tracker\templates\vehicle\vehicles.toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e80860d21dbd3_73810402',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eaac2ff20b212c532166908eb33a949eff2e65bd' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\vehicle\\vehicles.toolbar.tpl',
      1 => 1585481225,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e80860d21dbd3_73810402 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='toolbar'><div class='left'><button type='button' class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick="window.history.back();" ><i class="fas fa-arrow-alt-left fa-fw"></i></button><button type='button' class='toolbar-button standard-tooltip' title='Create a new vehicle' onclick="Vehicles.processAddVehicle();" ><i class="fas fa-plus fa-fw"></i></button></div><div class="right"><button type="button" class="toolbar-button" onclick="Vehicles.sendTestEmail();"><i class="fas fa-alarm-plus"></i></button></div></div><?php }
}
