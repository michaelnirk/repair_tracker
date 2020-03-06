<?php
/* Smarty version 3.1.30, created on 2020-02-22 13:01:09
  from "C:\develope\repair_tracker_v2\templates\repair\repairs.toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e5126152d5115_30512076',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b0a2d133143fc718a58083ae629c89d4fb51887' => 
    array (
      0 => 'C:\\develope\\repair_tracker_v2\\templates\\repair\\repairs.toolbar.tpl',
      1 => 1582371907,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e5126152d5115_30512076 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='toolbar'><div class='left'><button type="button" class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick='window.history.back();' ><i class="fas fa-arrow-alt-left fa-fw"></i></button><button type="button" id='createRepairButton' class='toolbar-button standard-tooltip' title="Create a new repair for this vehicle" onclick="Repairs.processAddRepair();" ><i class="fas fa-plus fa-fw"></i></button></a></div></div><?php }
}
