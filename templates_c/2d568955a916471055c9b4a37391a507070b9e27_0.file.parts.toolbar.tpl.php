<?php
/* Smarty version 3.1.30, created on 2020-02-22 23:38:10
  from "C:\develope\repair_tracker_v2\templates\part\parts.toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e51bb62608955_39209095',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d568955a916471055c9b4a37391a507070b9e27' => 
    array (
      0 => 'C:\\develope\\repair_tracker_v2\\templates\\part\\parts.toolbar.tpl',
      1 => 1582414685,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e51bb62608955_39209095 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='toolbar'><div class='left'><button type="button" class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick='window.history.back();' ><i class="fas fa-arrow-alt-left fa-fw"></i></button><button type="button" id='createPartButton' class='toolbar-button standard-tooltip' title="Create a new part for this repair" onclick="Parts.processAddPart();" ><i class="fas fa-plus fa-fw"></i></button></a></div></div><?php }
}
