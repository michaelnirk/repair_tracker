<?php
/* Smarty version 3.1.30, created on 2020-04-10 10:39:44
  from "C:\develop\repair_tracker\templates\toolbar_parent.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e904cf0ba94b8_36662341',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f45e237bbe846931d53a53edf403cc15c3e9d57' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\toolbar_parent.tpl',
      1 => 1586515180,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e904cf0ba94b8_36662341 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<link href="css/menu.css" rel="stylesheet"><div class='toolbar'><div class='left'><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20319663185e904cf0ba4168_11274301', 'leftContent');
?>
</div><div class="right"><div id='menuWrapper'><button type="button" class="toolbar-button standard-tooltip" title='Show menu' onclick="SideNav.showSideNav(event);"><i class="fas fa-bars fa-fw"></i></button></div></div></div><?php }
/* {block 'leftContent'} */
class Block_20319663185e904cf0ba4168_11274301 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'leftContent'} */
}
