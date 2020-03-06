<?php
/* Smarty version 3.1.30, created on 2020-02-04 19:39:22
  from "C:\develope\repair_tracker_v2\templates\repair\list_repairs.toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e39c86a269e33_03511750',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32291529c61a65aa2320579a02f01be3774396c9' => 
    array (
      0 => 'C:\\develope\\repair_tracker_v2\\templates\\repair\\list_repairs.toolbar.tpl',
      1 => 1580845148,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e39c86a269e33_03511750 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='toolbar'><div class='left'><button type="button" class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick='window.history.back();' ><i class="fas fa-arrow-alt-left"></i></button><button type="button" id='createRepairButton' class='toolbar-button standard-tooltip' title="Create a new repair for this vehicle" data-href='index.php?module=repair&action=create_repair' onmouseup="LinkController.buttonClickedAsLink(this, event);" ><i class="fas fa-plus"></i></button></a></div></div><?php }
}
